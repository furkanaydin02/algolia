<?php

namespace App\Command;

use Algolia\AlgoliaSearch\Exceptions\MissingObjectId;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Algolia\AlgoliaSearch\SearchClient;

class AddProductsCommand extends Command
{
    protected static $defaultName = 'app:add-products';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws MissingObjectId
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Started");

        $client = SearchClient::create('9PWCLVWSO2', '9b05ae90138375c8a3c7ee890e543580');

        $index = $client->initIndex('Index');

        $products = [
            ['product_id' => 1, 'name' => 'iPhone X', 'description' => 'Apple iPhone X, 64 GB, Uzay Grisi', 'price' => 999],
            ['product_id' => 2, 'name' => 'Samsung Galaxy S21', 'description' => 'Samsung Galaxy S21, 128 GB, Phantom Siyah', 'price' => 799],
            ['product_id' => 3, 'name' => 'Google Pixel 5', 'description' => 'Google Pixel 5, 128 GB, Açık Sarı', 'price' => 699],
        ];

        $options = [
            'objectIDKey' => 'product_id'
        ];

        $index->saveObjects($products, $options);

        $output->writeln("Completed");

        return Command::SUCCESS;
    }
}
