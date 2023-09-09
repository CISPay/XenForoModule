<?php

namespace CISPay\PaygateCISPay;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	private static $baseClass = "CISPay";

	public function installStep1(): void
	{
		$db = $this->db();

		$db->insert('xf_payment_provider', [
			'provider_id'    => "cp" . self::$baseClass,
			'provider_class' => "CISPay\\Paygate" . self::$baseClass . ":" . self::$baseClass,
			'addon_id'       => "CISPay/Paygate" . self::$baseClass
		]);
	}

	public function uninstallStep1(): void
	{
		$providerId = "cp" . self::$baseClass;

		$db = $this->db();

		$db->delete('xf_payment_profile', "provider_id = '$providerId'");
		$db->delete('xf_payment_provider', "provider_id = '$providerId'");
	}
}