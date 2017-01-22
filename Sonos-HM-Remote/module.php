<?

	class HMSonosRemote extends IPSModule {

	public function Create() {

		parent::Create();

		$this->RegisterPropertyInteger("idsonos", "");
		$this->RegisterPropertyString("serial6t", "");
		$this->RegisterPropertyString("iddisplay", "");
		$this->RegisterPropertyString("zeile1", "Temperatur");
		$this->RegisterPropertyString("zeile2", "Garten");
		$this->RegisterPropertyInteger("idvar", "");

	}

	public function ApplyChanges() {

		parent::ApplyChanges();

		if (($this->ReadPropertyString("iddisplay") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
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
