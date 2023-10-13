<?php declare(strict_types=1);

namespace VitesseCms\Log\Repositories;

use VitesseCms\Database\Models\FindOrderIterator;
use VitesseCms\Database\Models\FindValueIterator;
use VitesseCms\Log\Models\Log;
use VitesseCms\Log\Models\LogIterator;

class LogRepository {
    public function getById(string $id, bool $hideUnpublished = true): ?Log
    {
        Log::setFindPublished($hideUnpublished);

        /** @var Log $log */
        $log = Log::findById($id);
        if (is_object($log)):
            return $log;
        endif;

        return null;
    }

    public function findAll(
        ?FindValueIterator $findValues = null,
        bool               $hideUnpublished = true,
        ?int               $limit = null,
        ?FindOrderIterator $findOrders = null
    ): LogIterator
    {
        Log::setFindPublished($hideUnpublished);
        if ($limit !== null) {
            Log::setFindLimit($limit);
        }

        $this->parseFindValues($findValues);
        $this->parseFindOrders($findOrders);

        return new LogIterator(Log::findAll());
    }

    protected function parseFindValues(?FindValueIterator $findValues = null): void
    {
        if ($findValues !== null) :
            while ($findValues->valid()) :
                $findValue = $findValues->current();
                Log::setFindValue(
                    $findValue->getKey(),
                    $findValue->getValue(),
                    $findValue->getType()
                );
                $findValues->next();
            endwhile;
        endif;
    }

    protected function parseFindOrders(?FindOrderIterator $findOrders = null): void
    {
        if ($findOrders !== null) :
            while ($findOrders->valid()) :
                $findOrder = $findOrders->current();
                Log::addFindOrder(
                    $findOrder->getKey(),
                    $findOrder->getOrder()
                );
                $findOrders->next();
            endwhile;
        endif;
    }
}