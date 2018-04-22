<?php
/**
 * Created by PhpStorm.
 * User: stefanodegenkamp
 * Date: 22/04/2018
 * Time: 13:31
 */

namespace App\Service;


use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    public function parse(string $source, AdapterInterface $cache, MarkdownInterface $markdown): string
    {
        $item = $cache->getItem("markdown_".md5($source));
        if (!$item->isHit()) {
            $item->set($markdown->transform($source));
            $cache->save($item);
        }

        return $item->get();
    }
}