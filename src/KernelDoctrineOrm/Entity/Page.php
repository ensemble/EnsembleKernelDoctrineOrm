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

namespace Ensemble\KernelDoctrineOrm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Ensemble\Kernel\Model\PageInterface;
use Ensemble\Kernel\Model\PageCollection;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Ensemble\KernelDoctrineOrm\Repository\Page")
 */
class Page implements PageInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var integer
     */
    protected $id;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     * @var integer
     */
    protected $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     * @var integer
     */
    protected $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     * @var integer
     */
    protected $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     * @var integer
     */
    protected $root;

    /**
     * @ORM\Column(name="order", type="integer", nullable=true)
     * @var integer
     */
    protected $order;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Ensemble\KernelDoctrineOrm\Entity\Page", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     * @var Page
     */
    protected $parent;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $visible = true;

    /**
     * @ORM\OneToMany(targetEntity="Ensemble\KernelDoctrineOrm\Entity\Page", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     * @var ArrayCollection
     */
    protected $children;

    /**
     * @var PageCollection
     */
    protected $childrenCollection;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $route;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $module;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var string
     */
    protected $moduleId;

    /**
     * @ORM\OneToOne(targetEntity="Ensemble\KernelDoctrineOrm\Entity\MetaData", mappedBy="page")
     * @var MetaData
     */
    protected $metaData;

    /**
     * Constructor
     */
    public function __construct ()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * @return int
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * @param $lft
     * @return Page
     */
    public function setLft($lft)
    {
        $this->lft = (int) $lft;
        return $this;
    }

    /**
     * @return int
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * @param $lvl
     * @return Page
     */
    public function setLvl($lvl)
    {
        $this->lvl = (int) $lvl;
        return $this;
    }

    /**
     * @return int
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * @param $rgt
     * @return Page
     */
    public function setRgt($rgt)
    {
        $this->rgt = (int) $rgt;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param $root
     * @return Page
     */
    public function setRoot($root)
    {
        $this->root = $root;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param $order
     * @return Page
     */
    public function setOrder($order)
    {
        $this->order = (int) $order;
        return $this;
    }

    /**
     * @return Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Page $parent
     * @return Page
     */
    public function setParent(Page $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return PageCollection
     */
    public function getChildren()
    {
        if (!$this->childrenCollection instanceof PageCollection) {
            $this->childrenCollection = new PageCollection($this->children->toArray());
        }

        return $this->childrenCollection;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return (bool) count($this->children);
    }

    /**
     * @param  PageCollection $children
     * @return Page
     */
    public function setChildren(PageCollection $children)
    {
        $this->childrenCollection = $children;
        $this->children           = $children->getArrayCopy();

        return $this;
    }

    /**
     * @return bool
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->getVisible();
    }

    /**
     * @param $visible
     * @return Page
     */
    public function setVisible($visible)
    {
        $this->visible = (bool) $visible;
        return $this;
    }

    /**
     * @param bool $includeParent
     * @return string
     */
    public function getRoute($includeParent = false)
    {
        if (false === $includeParent) {
            return $this->route;
        }

        $page  = $this;
        $route = array();
        do {
            $route[] = $page->getRoute(false);
        } while (($page = $page->getParent()) instanceof self);

        $route = array_reverse($route);
        return implode('/', $route);
    }

    /**
     * @param $route
     * @return Page
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param $module
     * @return Page
     */
    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @return int
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * @param $moduleId
     * @return Page
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = (int) $moduleId;
        return $this;
    }

    /**
     * @return MetaData
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    /**
     * @param MetaData $metaData
     * @return Page
     */
    public function setMetaData(MetaData $metaData)
    {
        $this->metaData = $metaData;
        return $this;
    }
}