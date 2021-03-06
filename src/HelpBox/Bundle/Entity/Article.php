<?php

namespace HelpBox\Bundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="HelpBox\Bundle\Entity\ArticleRepository")
 */
class Article implements Translatable
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $id;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @Orm\ManyToOne(targetEntity="Categorie", inversedBy="articles",cascade={"persist"})
     */
    private $categorie;
    

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Set categorie
     *
     * @param \HelpBox\Bundle\Entity\Categorie $categorie
     * @return Article
     */
    public function setCategorie(\HelpBox\Bundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \HelpBox\Bundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    public function __toString()
    {
        return $this->title;
    }
}
