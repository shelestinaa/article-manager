<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTimeImmutable;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ArticleService
{
    /**
     * @param ArticleRepository $articleRepository
     */
    public function __construct(
        private ArticleRepository   $articleRepository,
        private HttpClientInterface $client
    )
    {
    }


    public function updateArticlesByUrl(string $url) :void
    {
        $relevantArticles = $this->grabRelevantArticles($url);
        $existingArticlesIds = $this->getAllOfArticleIds();
        $arrayDiffKeys = array_diff_key(array_keys($relevantArticles), $existingArticlesIds);

        foreach ($arrayDiffKeys as $id) {
            $this->articleRepository->save($relevantArticles[$id], true);
        }
    }

    private function grabRelevantArticles(string $url): array
    {
        $response = $this->client->request(
            'GET',
            $url,
            ['headers' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'br,deflate,gzip,x-gzip',
            ],
            ]
        );

        $dateCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
            return (new DateTimeImmutable($innerObject));
        };

        $defaultContext = [
            AbstractNormalizer::CALLBACKS => [
                'dateCreated' => $dateCallback,
            ]
        ];

        $serializer = new Serializer([new ObjectNormalizer(defaultContext: $defaultContext), new DateTimeNormalizer()], [new JsonEncoder()]);

        $result = [];
        foreach (json_decode($response->getContent()) as $article) {
            /** @var Article $deserialized */
            $deserialized = ($serializer->deserialize(json_encode($article), Article::class, 'json'));

            $result[$deserialized->getId()] = $deserialized;
        }

        return $result;
    }

    private function getAllOfArticleIds(): array
    {
        $serialized = [];
        $articlesIds = $this->articleRepository->getArticlesIds();
        foreach ($articlesIds as $value) {
            $serialized[] = $value['id'];
        }
        return $serialized;
    }

}