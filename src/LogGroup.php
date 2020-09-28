<?php
namespace Le2le\AliyunLog;



// message LogGroup
class LogGroup
{
	private $_unknown;

	public function __construct($in = NULL, &$limit = PHP_INT_MAX)
	{
		if($in !== NULL)
		{
			if(is_string($in))
			{
				$fp = fopen('php://memory', 'r+b');
				fwrite($fp, $in);
				rewind($fp);
			}
			elseif(is_resource($in))
			{
				$fp = $in;
			}
			else
			{
				throw new Exception('Invalid in parameter');
			}
			$this->read($fp, $limit);
		}
	}

	public function read($fp, &$limit = PHP_INT_MAX)
	{
		while (!feof($fp) && $limit > 0)
		{
			$tag = Protobuf::read_varint($fp, $limit);
			if($tag === false)
				break;
			$wire  = $tag & 0x07;
			$field = $tag >> 3;
			//var_dump("LogGroup: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
			switch ($field)
			{
				case 1:
					ASSERT('$wire == 2');
					$len = Protobuf::read_varint($fp, $limit);
					if($len === false)
						throw new Exception('Protobuf::read_varint returned false');
					$limit         -= $len;
					$this->logs_[] = new Log($fp, $len);
					ASSERT('$len == 0');
					break;
				case 2:
					ASSERT('$wire == 2');
					$len = Protobuf::read_varint($fp, $limit);
					if($len === false)
						throw new Exception('Protobuf::read_varint returned false');
					if($len > 0)
						$tmp = fread($fp, $len);
					else
						$tmp = '';
					if($tmp === false)
						throw new Exception("fread($len) returned false");
					$this->reserved_ = $tmp;
					$limit           -= $len;
					break;
				case 3:
					ASSERT('$wire == 2');
					$len = Protobuf::read_varint($fp, $limit);
					if($len === false)
						throw new Exception('Protobuf::read_varint returned false');
					if($len > 0)
						$tmp = fread($fp, $len);
					else
						$tmp = '';
					if($tmp === false)
						throw new Exception("fread($len) returned false");
					$this->topic_ = $tmp;
					$limit        -= $len;
					break;
				case 4:
					ASSERT('$wire == 2');
					$len = Protobuf::read_varint($fp, $limit);
					if($len === false)
						throw new Exception('Protobuf::read_varint returned false');
					if($len > 0)
						$tmp = fread($fp, $len);
					else
						$tmp = '';
					if($tmp === false)
						throw new Exception("fread($len) returned false");
					$this->source_ = $tmp;
					$limit         -= $len;
					break;
				default:
					$this->_unknown[$field.'-'.Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
			}
		}
		if(!$this->validateRequired())
			throw new Exception('Required fields are missing');
	}

	public function write($fp)
	{
		if(!$this->validateRequired())
			throw new Exception('Required fields are missing');
		if(!is_null($this->logs_))
			foreach ($this->logs_ as $v)
			{
				fwrite($fp, "\x0a");
				Protobuf::write_varint($fp, $v->size()); // message
				$v->write($fp);
			}
		if(!is_null($this->reserved_))
		{
			fwrite($fp, "\x12");
			Protobuf::write_varint($fp, strlen($this->reserved_));
			fwrite($fp, $this->reserved_);
		}
		if(!is_null($this->topic_))
		{
			fwrite($fp, "\x1a");
			Protobuf::write_varint($fp, strlen($this->topic_));
			fwrite($fp, $this->topic_);
		}
		if(!is_null($this->source_))
		{
			fwrite($fp, "\"");
			Protobuf::write_varint($fp, strlen($this->source_));
			fwrite($fp, $this->source_);
		}
	}

	public function size()
	{
		$size = 0;
		if(!is_null($this->logs_))
			foreach ($this->logs_ as $v)
			{
				$l    = $v->size();
				$size += 1 + Protobuf::size_varint($l) + $l;
			}
		if(!is_null($this->reserved_))
		{
			$l    = strlen($this->reserved_);
			$size += 1 + Protobuf::size_varint($l) + $l;
		}
		if(!is_null($this->topic_))
		{
			$l    = strlen($this->topic_);
			$size += 1 + Protobuf::size_varint($l) + $l;
		}
		if(!is_null($this->source_))
		{
			$l    = strlen($this->source_);
			$size += 1 + Protobuf::size_varint($l) + $l;
		}

		return $size;
	}

	public function validateRequired()
	{
		return true;
	}

	public function __toString()
	{
		return ''.Protobuf::toString('unknown', $this->_unknown).Protobuf::toString('logs_',
				$this->logs_).Protobuf::toString('reserved_', $this->reserved_).Protobuf::toString('topic_',
				$this->topic_).Protobuf::toString('source_', $this->source_);
	}

	// repeated .Log logs = 1;

	private $logs_ = null;

	public function clearLogs()
	{
		$this->logs_ = null;
	}

	public function getLogsCount()
	{
		if($this->logs_ === null)
			return 0;
		else return count($this->logs_);
	}

	public function getLogs($index)
	{
		return $this->logs_[$index];
	}

	public function getLogsArray()
	{
		if($this->logs_ === null)
			return array();
		else return $this->logs_;
	}

	public function setLogs($index, $value)
	{
		$this->logs_[$index] = $value;
	}

	public function addLogs($value)
	{
		$this->logs_[] = $value;
	}

	public function addAllLogs(array $values)
	{
		foreach ($values as $value)
		{
			$this->logs_[] = $value;
		}
	}

	// optional string reserved = 2;

	private $reserved_ = null;

	public function clearReserved()
	{
		$this->reserved_ = null;
	}

	public function hasReserved()
	{
		return $this->reserved_ !== null;
	}

	public function getReserved()
	{
		if($this->reserved_ === null)
			return "";
		else return $this->reserved_;
	}

	public function setReserved($value)
	{
		$this->reserved_ = $value;
	}

	// optional string topic = 3;

	private $topic_ = null;

	public function clearTopic()
	{
		$this->topic_ = null;
	}

	public function hasTopic()
	{
		return $this->topic_ !== null;
	}

	public function getTopic()
	{
		if($this->topic_ === null)
			return "";
		else return $this->topic_;
	}

	public function setTopic($value)
	{
		$this->topic_ = $value;
	}

	// optional string source = 4;

	private $source_ = null;

	public function clearSource()
	{
		$this->source_ = null;
	}

	public function hasSource()
	{
		return $this->source_ !== null;
	}

	public function getSource()
	{
		if($this->source_ === null)
			return "";
		else return $this->source_;
	}

	public function setSource($value)
	{
		$this->source_ = $value;
	}

	// @@protoc_insertion_point(class_scope:LogGroup)
}