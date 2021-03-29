<?php declare(strict_types=1);

namespace VitesseCms\Log\Services;

use MongoDB\BSON\ObjectId;
use VitesseCms\Core\AbstractInjectable;
use VitesseCms\Log\Models\Log;

class LogService extends AbstractInjectable
{
    public function write(ObjectId $itemId, string $class, string $message, bool $published = true): bool
    {
        $userId = null;
        if($this->user !== null) :
            $userId = $this->user->getId();
        endif;

        return (new Log())
            ->setItemId($itemId)
            ->setClass($class)
            ->setMessage($message)
            ->setUserId($userId)
            ->setPublished($published)
            ->setIpAddress($_SERVER['REMOTE_ADDR'])
            ->setProperty($_SERVER['HTTP_HOST'])
            ->setSourceUri($_SERVER['REQUEST_URI'])
            ->setPost(serialize($this->request->getPost()))
            ->save();
    }
}
