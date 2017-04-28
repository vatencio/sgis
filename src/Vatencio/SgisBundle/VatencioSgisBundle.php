<?php

namespace Vatencio\SgisBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VatencioSgisBundle extends Bundle
{
	 public function getParent()
    {
		return 'FOSUserBundle';
    }
}
