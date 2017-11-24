<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Article;

class AppExtension extends \Twig_Extension {
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction("getAllTags", [$this, "getAllTags"])
        ];
    }

    /**
     * @param \AppBundle\Entity\Article $article
     * @return string
     */
    public function getAllTags(Article $article)
    {
        $labels = [];
        foreach ($article->getTags() as $tag)
        {
            $labels[] = $tag->getName();
        }
        return join(", ", $labels);
    }

}