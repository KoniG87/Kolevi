<?php

class kolevesPDF extends TCPDF{
	public function Footer() {
		$footer = '<hr style="width:98%;height:4px;border-color:#6d6d6d;"/>
			<p>
			Szervízdíjat nem számolunk fel, ezért ha elégedettek voltatok, <br/>
			a borravalót a pincéreknek adjátok oda! Köszönjük!<br/><br/>
			
			Kreatív chef: Bezdán Anita • Chef: Bíró Dániel • Üzletvezető: Dyssou Bona • Vendéglősök: Elek Imola, Kápolnai Gábor Zebulon<br/>
			Szeressétek: www.facebook.com/koleves Véleményeteket írjátok meg a www.tripadvisor.com/koleves oldalon<br/><br/>

			www.koleves.com
		</p>';
		$this->writeHTML($footer, true, false, true, false, '');
		
	}
	
}

?>