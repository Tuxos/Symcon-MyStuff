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
		$this->RegisterPropertyString("postfix", "c");

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

				if (@IPS_GetInstanceIDByName("6fach Taster", $this->InstanceID) == false) {
					$InsID = IPS_CreateInstance("{4FA0F15F-50A6-451C-8B03-E76A425C2B94}");
					IPS_SetName($InsID, "6fach Taster");
					IPS_SetParent($InsID, $this->InstanceID);
				}
				IPS_SetConfiguration(@IPS_GetInstanceIDByName("6fach Taster", $this->InstanceID), '{"serialnumber":"'.$this->ReadPropertyString("serial6t").'"}');
				@IPS_ApplyChanges(@IPS_GetInstanceIDByName("6fach Taster", $this->InstanceID));

				if (@IPS_GetEventIDByName("when title change") == false) {
					$eid = IPS_CreateEvent(0);
					IPS_SetName($eid, "when title change");
					IPS_SetEventTrigger($eid, 1, IPS_GetObjectIDByName("Title", $this->ReadPropertyString("idsonos")));
					IPS_SetEventScript($eid, "HMSR_anzeigeTitel($this->InstanceID);");
					IPS_SetEventActive($eid, true);
				}

			}

		if (($this->ReadPropertyString("serialdisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
			{
				$this->SetStatus(102);
			} else {
				$this->SetStatus(202);
			}

	}

	// Anzeige wenn keine Musik spielt
	public function anzeigePause() {

		$temperatur = GetValue($this->ReadPropertyString("idvar"));
		$displayid = GetValue(IPS_GetObjectIDByName("Display Taster", $this->InstanceID));
		$titel = GetValue(IPS_GetObjectIDByName("Title", $this->ReadPropertyString("idsonos")));

		if ($titel == "") {
			HMDIS_writeDisplay($displayid,  $this->ReadPropertyString("zeile1"), $this->ReadPropertyString("zeile2"), $temperatur.$this->ReadPropertyString("postfix"), "", "", "", "0XF0", "0xC0");
			}


		}

	// Anzeige wenn Musik spielt
	public function anzeigeTitel() {

		$temperatur = GetValue($this->ReadPropertyString("idvar"));
		$displayid = IPS_GetObjectIDByName("Display Taster", $this->InstanceID);
		$sonosid =  $this->ReadPropertyString("idsonos");

		$titel = GetValue(IPS_GetObjectIDByName("Title", $sonosid));
		$artist = GetValue(IPS_GetObjectIDByName("Artist", $sonosid));
		$album = GetValue(IPS_GetObjectIDByName("Album", $sonosid));

		$titel1= substr($titel ,0, 12);
		$titel2= substr($titel, 12);

		if ($titel1 == "") $titel1 = " ";
		if (($titel2 == "") && ($album == "")) $titel2 = " ";
		if (($titel2 == "") && ($album != "")) $titel2 = $album;
		if ($artist == "") $artist = " ";

   		if ($titel == "") {
			HMSR_anzeigePause($this->InstanceID);
			} else {
			HMDIS_writeDisplay($displayid, $titel1, $titel2, $artist, "", "", "", "0XF0", "0xC0");
		}

		}

	}
?>
