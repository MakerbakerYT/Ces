{
	public function getNetworkType(): int {
		return AvailableCommandsPacket::ARG_TYPE_POSITION;
	}

	public function getTypeName(): string {
		return "x y z";
	}

	public function canParse(string $testString, CommandSender $sender): bool {
		$coords = explode(" ", $testString);
		if(count($coords) === 3) {
			foreach($coords as $coord) {
				if(!$this->isValidCoordinate($coord, $sender instanceof Vector3)) {
					return false;
				}
			}

			return true;
		}

		return false;
	}

	public function isValidCoordinate(string $coordinate, bool $locatable): bool {
		return (bool)preg_match("/^(?:" . ($locatable ? "(?:~-|~\+)?" : "") . "-?(?:\d+|\d*\.\d+))" . ($locatable ? "|~" : "") . "$/", $coordinate);
	}

	public function parse(string $argument, CommandSender $sender) {
		$coords = explode(" ", $argument);
		$vals = [];
		foreach($coords as $k => $coord){
			$offset = 0;
			// if it's locatable and starts with ~- or ~+
			if($sender instanceof Vector3 && preg_match("/^(?:~-|~\+)|~/", $coord)){
				// this will work with -n, +n and "" due to typecast later
				$offset = substr($coord, 1);

				// replace base coordinate with actual entity coordinates
				switch($k){
					case 0:
						$coord = $sender->x;
						break;
					case 1:
						$coord = $sender->y;
						break;
					case 2:
						$coord = $sender->z;
						break;
				}
			}
			$vals[] = (float)$coord + (float)$offset;
		}
		return new Vector3(...$vals);
	}

	public function getSpanLength(): int {
		return 3;
	}
}
