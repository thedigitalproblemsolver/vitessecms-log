<?php declare(strict_types=1);

namespace VitesseCms\Log\Services;

use MongoDB\BSON\ObjectId;
use VitesseCms\Core\AbstractInjectable;
use VitesseCms\Log\Models\Log;

class LogService extends AbstractInjectable
{
    public function write(ObjectId $itemId, string $class, string $message, bool $published = true): bool
    {
        return $this->createLog($message, $published)->setItemId($itemId)->setClass($class)->save();
    }

    public function message(string $message, bool $published = true): bool
    {
        return $this->createLog($message, $published)->save();
    }

    private function createLog(string $message, bool $published = true): Log
    {
        $userId = null;
        if($this->user !== null) :
            $userId = $this->user->getId();
        endif;

        return (new Log())
            ->setUserId($userId)
            ->setPublished($published)
            ->setMessage($message)
            ->setIpAddress($_SERVER['REMOTE_ADDR'])
            ->setProperty($_SERVER['HTTP_HOST'])
            ->setSourceUri($_SERVER['REQUEST_URI'])
            ->setPost(serialize($this->request->getPost()));
    }
}
