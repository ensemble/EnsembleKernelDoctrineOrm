<?php

namespace SlmCmfKernelDoctrineOrm\Entity;

use SlmCmfKernel\Model\MetaDataInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="page_metadata")
 */
class MetaData implements MetaDataInterface
{    
    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="SlmCmfKernelDoctrineOrm\Entity\Page", inversedBy="metaData")
     * @var Page
     */
    protected $page;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $longTitle;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $shortTitle;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $keywords;
    
    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }
    
    public function getTitle ()
    {
        return $this->title;
    }
    
    public function setTitle ($title)
    {
        $this->title = (string) $title;
        return $this;
    }
    
    public function getShortTitle ()
    {
        return $this->shortTitle;
    }
    
    public function setShortTitle ($shortTitle)
    {
        $this->shortTitle = (string) $shortTitle;
        return $this;
    }
    
    public function hasShortTitle ()
    {
        return !empty($this->shortTitle);
    }
    
    public function getNavigationTitle()
    {
        if ($this->hasShortTitle()) {
            return $this->getShortTitle();
        } else {
            return $this->getTitle();
        }
    }
    
    public function getLongTitle ()
    {
        return $this->longTitle;
    }
    
    public function setLongTitle ($longTitle)
    {
        $this->longTitle = (string) $longTitle;
        return $this;
    }
    
    public function hasLongTitle ()
    {
        return !empty($this->longTitle);
    }
    
    public function getDescriptiveTitle()
    {
        if ($this->hasLongTitle()) {
            return $this->getLongTitle();
        } else {
            return $this->getTitle();
        }
    }
    
    public function getDescription ()
    {
        return $this->description;
    }
    
    public function setDescription ($description)
    {
        $this->description = (string) $description;
        return $this;
    }
    
    public function getKeywords ()
    {
        return $this->keywords;
    }
    
    public function setKeywords ($keywords)
    {
        $this->keywords = (string) $keywords;
        return $this;
    }
}