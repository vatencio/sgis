<?php

namespace Vatencio\SgisBundle\Entity;

/**
 * Tbldocente
 */
class Tbldocente
{
    /**
     * @var integer
     */
    private $intiddocente;

    /**
     * @var string
     */
    private $strespecialidad;

    /**
     * @var string
     */
    private $struser;

    /**
     * @var string
     */
    private $strpassword;

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
     * @var \Vatencio\SgisBundle\Entity\Tblpersona
     */
    private $intidpersona;

    /**
     * @var \Vatencio\SgisBundle\Entity\FosUser
     */
    private $intidfosuser;


    /**
     * Get intiddocente
     *
     * @return integer
     */
    public function getIntiddocente()
    {
        return $this->intiddocente;
    }

    /**
     * Set strespecialidad
     *
     * @param string $strespecialidad
     *
     * @return Tbldocente
     */
    public function setStrespecialidad($strespecialidad)
    {
        $this->strespecialidad = $strespecialidad;

        return $this;
    }

    /**
     * Get strespecialidad
     *
     * @return string
     */
    public function getStrespecialidad()
    {
        return $this->strespecialidad;
    }

    /**
     * Set struser
     *
     * @param string $struser
     *
     * @return Tbldocente
     */
    public function setStruser($struser)
    {
        $this->struser = $struser;

        return $this;
    }

    /**
     * Get struser
     *
     * @return string
     */
    public function getStruser()
    {
        return $this->struser;
    }

    /**
     * Set strpassword
     *
     * @param string $strpassword
     *
     * @return Tbldocente
     */
    public function setStrpassword($strpassword)
    {
        $this->strpassword = $strpassword;

        return $this;
    }

    /**
     * Get strpassword
     *
     * @return string
     */
    public function getStrpassword()
    {
        return $this->strpassword;
    }

    /**
     * Set dtmcreacion
     *
     * @param \DateTime $dtmcreacion
     *
     * @return Tbldocente
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
     * @return Tbldocente
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
     * @return Tbldocente
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
     * @return Tbldocente
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
     * Set intidpersona
     *
     * @param \Vatencio\SgisBundle\Entity\Tblpersona $intidpersona
     *
     * @return Tbldocente
     */
    public function setIntidpersona(\Vatencio\SgisBundle\Entity\Tblpersona $intidpersona = null)
    {
        $this->intidpersona = $intidpersona;

        return $this;
    }

    /**
     * Get intidpersona
     *
     * @return \Vatencio\SgisBundle\Entity\Tblpersona
     */
    public function getIntidpersona()
    {
        return $this->intidpersona;
    }

    /**
     * Set intidfosuser
     *
     * @param \Vatencio\SgisBundle\Entity\FosUser $intidfosuser
     *
     * @return Tbldocente
     */
    public function setIntidfosuser(\Vatencio\SgisBundle\Entity\FosUser $intidfosuser = null)
    {
        $this->intidfosuser = $intidfosuser;

        return $this;
    }

    /**
     * Get intidfosuser
     *
     * @return \Vatencio\SgisBundle\Entity\FosUser
     */
    public function getIntidfosuser()
    {
        return $this->intidfosuser;
    }
    
    public function __toString() 
    {
        $name = $this->getIntidpersona()->getStrprimernombre()." ".$this->getIntidpersona()->getStrsegundonombre()." ".$this->getIntidpersona()->getStrprimerapellido()." ".$this->getIntidpersona()->getStrsegundoapellido();
        return $name;
    }
}
