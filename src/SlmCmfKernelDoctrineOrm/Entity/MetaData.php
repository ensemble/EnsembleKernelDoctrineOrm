<?php
/**
 * Copyright (c) 2012 Soflomo http://soflomo.com.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of the
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package     Ensemble\KernelDoctrineORM
 * @author      Jurian Sluiman <jurian@soflomo.com>
 * @copyright   2012 Soflomo http://soflomo.com.
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://ensemble.github.com
 */

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
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var integer
     */
    protected $id;

    /**
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