<?

	class HMSonosRemote extends IPSModule {

	public function Create() {

		parent::Create();

		$this->RegisterPropertyInteger("iddisplay", "");
		$this->RegisterPropertyInteger("idsonos", "");
		$this->RegisterPropertyString("serial6t", "");
		$this->RegisterPropertyString("zeile1", "Temperatur");
		$this->RegisterPropertyString("zeile2", "Garten");
		$this->RegisterPropertyInteger("idvar", "");

	}

	public function ApplyChanges() {

		parent::ApplyChanges();

		if (($this->ReadPropertyString("iddisplay") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != "")
			{
				$this->SetStatus(102);
			} else {
				$this->SetStatus(202);
			}

	}

	// Berechne Kosten
	public function price() {

		$meteryesterday = GetValue(IPS_GetObjectIDByName("Verbrauch gestern",$this->InstanceID));

		SetValue(IPS_GetObjectIDByName("Kosten gestern",$this->InstanceID), ($meteryesterday*$this->ReadPropertyFloat("price"))/100);




		}

	}
?>
