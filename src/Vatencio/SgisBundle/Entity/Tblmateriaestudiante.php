<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tblmateriaestudiante
 */
class Tblmateriaestudiante
{
    /**
     * @var integer
     */
    private $intidmateriaestudiante;

    /**
     * @var \DateTime
     */
    private $dtmcreacion;

    /**
     * @var string
     */
    private $strcreacion;

    /**
     * @var \DateTime
     */
    private $dtmactualizacion;

    /**
     * @var string
     */
    private $stractualizacion;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblestudiante
     */
    private $intidestudiante;

    /**
     * @var \Vatencio\SgisBundle\Entity\Tblmateria
     */
    private $intidmateria;


    /**
     * Get intidmateriaestudiante
     *
     * @return integer
     */
    public function getIntidmateriaestudiante()
    {
        return $this->intidmateriaestudiante;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tblmateriaestudiante
     */
    public function setDtmcreacion($dtmcreacion)
    {
        $this->dtmcreacion = $dtmcreacion;

        return $this;
    }

    /**
     * Get dtmcreacion
     *
     * @return \DateTime
     */
    public function getDtmcreacion()
    {
        return $this->dtmcreacion;
    }

    /**
     * Set strcreacion
     *
     * @param string $strcreacion
     *
     * @return Tblmateriaestudiante
     */
    public function setStrcreacion($strcreacion)
    {
        $this->strcreacion = $strcreacion;

        return $this;
    }

    /**
     * Get strcreacion
     *
     * @return string
     */
    public function getStrcreacion()
    {
        return $this->strcreacion;
    }

    /**
     * Set dtmactualizacion
     *
     * @param \DateTime $dtmactualizacion
     *
     * @return Tblmateriaestudiante
     */
    public function setDtmactualizacion($dtmactualizacion)
    {
        $this->dtmactualizacion = $dtmactualizacion;

        return $this;
    }

    /**
     * Get dtmactualizacion
     *
     * @return \DateTime
     */
    public function getDtmactualizacion()
    {
        return $this->dtmactualizacion;
    }

    /**
     * Set stractualizacion
     *
     * @param string $stractualizacion
     *
     * @return Tblmateriaestudiante
     */
    public function setStractualizacion($stractualizacion)
    {
        $this->stractualizacion = $stractualizacion;

        return $this;
    }

    /**
     * Get stractualizacion
     *
     * @return string
     */
    public function getStractualizacion()
    {
        return $this->stractualizacion;
    }

    /**
     * Set intidestudiante
     *
     * @param \Vatencio\SgisBundle\Entity\Tblestudiante $intidestudiante
     *
     * @return Tblmateriaestudiante
     */
    public function setIntidestudiante(\Vatencio\SgisBundle\Entity\Tblestudiante $intidestudiante = null)
    {
        $this->intidestudiante = $intidestudiante;

        return $this;
    }

    /**
     * Get intidestudiante
     *
     * @return \Vatencio\SgisBundle\Entity\Tblestudiante
     */
    public function getIntidestudiante()
    {
        return $this->intidestudiante;
    }

    /**
     * Set intidmateria
     *
     * @param \Vatencio\SgisBundle\Entity\Tblmateria $intidmateria
     *
     * @return Tblmateriaestudiante
     */
    public function setIntidmateria(\Vatencio\SgisBundle\Entity\Tblmateria $intidmateria = null)
    {
        $this->intidmateria = $intidmateria;

        return $this;
    }

    /**
     * Get intidmateria
     *
     * @return \Vatencio\SgisBundle\Entity\Tblmateria
     */
    public function getIntidmateria()
    {
        return $this->intidmateria;
    }
}
