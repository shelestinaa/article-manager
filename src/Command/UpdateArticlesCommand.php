<?php

namespace App\Command;

use App\Service\ArticleService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(
    name: 'app:update-articles',
    description: 'Adding new articles by API',
    aliases: ['app:check-and-update-articles'],
    hidden: false
)]
class UpdateArticlesCommand extends Command
{
    public function __construct(
        private ArticleService $articleService,
    )
    {

        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('url', InputArgument::REQUIRED, 'URL of updating articles resource');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Starting updating articles table process. Please, wait!');
        try {
            $this->articleService->updateArticlesByUrl($input->getArgument('url'));
        } catch (\Exception $exception) {
            $output->writeln('An exception has been thrown: ' . $exception->getMessage());
            return Command::FAILURE;
        }

        $output->writeln('All articles are updated!');
        return Command::SUCCESS;
    }
}