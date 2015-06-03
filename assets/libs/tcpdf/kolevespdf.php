<?php

class kolevesPDF extends TCPDF{
	public function Footer() {
		$this->SetY(-47);
		$this->SetFont('freesans', '', 8);
		
		$footer = '
			<p style="text-align:center;">
			
			
				Szervízdíjat nem számolunk fel, ezért ha elégedettek voltatok, <br/>
			a borravalót a pincéreknek adjátok oda! Köszönjük!<br/><br/>
			
			Kreatív chef: Bezdán Anita • Chef: Bíró Dániel • Üzletvezető: Dyssou Bona • Vendéglősök: Elek Imola, Kápolnai Gábor Zebulon<br/>
			
			Szeressétek: <strong>www.facebook.com/koleves</strong> 
			Véleményeteket írjátok meg a <strong>www.tripadvisor.com/koleves</strong> oldalon<br/><br/>

			<strong>www.koleves.com</strong>
			
		</p>';
		$this->writeHTML($footer, true, false, true, false, '');
		
	}
	
}


class kolevesKertPDF extends TCPDF{
	public function Footer() {
		$this->SetY(-47);
		$this->SetFont('freesans', '', 8);

		

	}

}

?>