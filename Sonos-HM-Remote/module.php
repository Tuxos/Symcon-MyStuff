<?

	class HMSonosRemote extends IPSModule {

	public function Create() {

		parent::Create();

		$this->RegisterPropertyInteger("idsonos", "");
		$this->RegisterPropertyString("ipadressccu", "");
		$this->RegisterPropertyString("serial6t", "");
		$this->RegisterPropertyString("serialdisplay", "");
		$this->RegisterPropertyString("zeile1", "Temperatur");
		$this->RegisterPropertyString("zeile2", "Garten");
		$this->RegisterPropertyInteger("idvar", "");

	}

	public function ApplyChanges() {

		parent::ApplyChanges();

		if (($this->ReadPropertyString("serialdisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
			{
				if (@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID) == false) {
					$InsID = IPS_CreateInstance("{5961D2DF-90B1-4B98-A45E-B7717BD383C9}");
					IPS_SetName($InsID, "Display Taster");
					IPS_SetParent($InsID, $this->InstanceID);
				}
				IPS_SetConfiguration(@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID), '{"ipadress":"'.$this->ReadPropertyString("ipadressccu").'","serialnumber":"'.$this->ReadPropertyString("serialdisplay").'"}');
				@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID));
			}

		if (($this->ReadPropertyString("serialdisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
			{
				$this->SetStatus(102);
			} else {
				$this->SetStatus(202);
			}

	}

	// Zeige Sonos ID
	public function showid() {

		echo $this->ReadPropertyString('idsonos');


		}

	}
?>
