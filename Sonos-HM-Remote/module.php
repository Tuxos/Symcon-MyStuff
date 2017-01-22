<?

	class HMSonosRemote extends IPSModule {

	public function Create() {

		parent::Create();

		$this->RegisterPropertyInteger("idsonos", "");
		$this->RegisterPropertyString("ipadressccu", "192.168.1.8");
		$this->RegisterPropertyString("serial6t", "NEQ0434752");
		$this->RegisterPropertyString("serialdisplay", "NEQ1593741");
		$this->RegisterPropertyString("zeile1", "Temperatur");
		$this->RegisterPropertyString("zeile2", "Garten");
		$this->RegisterPropertyInteger("idvar", "");

	}

	public function ApplyChanges() {

		parent::ApplyChanges();

		if (@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{5961D2DF-90B1-4B98-A45E-B7717BD383C9}");
			IPS_SetName($InsID, "Display Taster");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		if (($this->ReadPropertyString("iddisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
			{
				IPS_SetConfiguration(@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID), '{"ipaddressccu":'.$this->ReadPropertyString("ipadressccu").',"serialnumber":'.$this->ReadPropertyString("serialdisplay").'}');
				@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID));
			}

		if (($this->ReadPropertyString("iddisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
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
