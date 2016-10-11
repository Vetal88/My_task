<?php
class LibrarySize 
{
    private $sizes = [
	    38 => 'XXS',
		40 => 'XS',
		42 => 'S',
		44 => 'M',
		46 => 'M',
		48 => 'L',
		50 => 'L',
		52 => 'XL',
		54 => 'XXL',
		56 => 'XXL',
		58 => 'XXXL'
	];
	
	public function translateSize($size)
	{
		if(isset($this->sizes[$size])) {
			return $this->sizes[$size];
		} else {
			return '-';
		}
	}
}