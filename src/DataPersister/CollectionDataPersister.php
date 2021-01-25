<?php

declare(strict_types = 1);

namespace App\DataPersister;


use App\Entity\Collection;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\CodeParser\CestLoader;
use OutOfBoundsException;

/**
 * DataPersister to persist Collection Requests to Cest-Files
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 */
final class CollectionDataPersister implements ContextAwareDataPersisterInterface
{
    private CestLoader $cestLoader;


    public function __construct(CestLoader $cestLoader)
    {
        $this->cestLoader = $cestLoader;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []) :bool
    {
        return ($data instanceof Collection);
    }

    
    /**
     * Persists the data.
     *
     * @param Collection $data
     * @param array $context
     */
    public function persist($data, array $context = []) :Collection
    {
        try {
            $this->cestLoader->findCestById($data->getId());
        } catch (OutOfBoundsException $e) {
            //$data = $this->cestLoader->createCest($data->getId());
        }
        return $data;
    }


    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        
    }
}
