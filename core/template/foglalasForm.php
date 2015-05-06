

                    <div class="row">
                        <div class="eight columns">
                            <h3>Kedves Vendégeink!</h3>

                            <p>Ezen a helyen csak a Kőleves Vendéglőbe tudsz asztalt foglalni maximum 7 főre,ha többen jönnétek, kérlek telefonáljatok.</p>
                            <p>Ha jó idő van, akkor talán a teraszon is ülhetsz, ha ott szeretnél asztalt, kérlek írd meg a megjegyzésbe. Foglalásod csak akkor érvényes, ha visszaigazoljuk e-mailben vagy telefonon.</p>
                            <p>Ha nagyobb rendezvényt szeretnél, kérlek telefonálj nekünk. <br> +3620 213 5999, +361 322 1011</p>
                            <p>A Kőleves Kert, ami egy különálló kocsma, külön grill konyhával, nem tévesztendő össze a vendéglővel, de ha oda szeretnél foglalni, próbáld meg a vendéglőt hívni. Oda csak 10 fő fölött és csak este 7-ig áll módunkban tartani az asztalt.</p>
                            <p>Késés esetén az asztalfoglalást 20 percig tartjuk, ha mégis lemondanád a foglalást, kérlek telefonálj nekünk.</p>
                        </div>    
                        <div class="three columns right">
                            <img data-src="assets/img/asztalfoglalas-img.png" alt="Asztalfoglalás" class="lazy illusztracio"><noscript><img src="assets/img/asztalfoglalas-img.png" alt="Asztalfoglalás"></noscript>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="twelve columns">
                            <div class="foglalas-form">
                                

                                <form id="nl-form" action="requestHandler.php" class="nl-form" name="nl-form">
                                    <input type="hidden" name="request" value="asztalfoglalasUpdate"/>
                                    <input type="hidden" name="id" value="0"/>
                                    <h3>Asztalfoglalás</h3>
                                    Sziasztok! 
                                    <input type="text" name="nev" class="formText"  value="" placeholder="XY" data-subline="Ide írd be a neved: <em>Vezetéknév</em> és <em>Keresztnév</em> is kell" required/>
                                    vagyok és nagyon szeretnék
                                    <select name="hanyfo" required>
                                        <option value="1" selected>egy</option>
                                        <option value="2">két</option>
                                        <option value="3">három</option>
                                        <option value="4">négy</option>
                                        <option value="5">öt</option>
                                        <option value="6">hat</option>
                                        <option value="7">hét</option>
            
                                    </select>
                                    főre foglalni egy asztalt a Kőlevesben

                                    <input type="text" class="datepicker"  name="datum" placeholder="ma" required/>
                                    <input type="text" class="timepicker"  name="ido" placeholder="13:30" required/>
                                    -kor. <br>
                                    
                                    <input type="text" class="formText"  name="email" required value="" placeholder="Erre az " data-subline="pl: <em>vendeg@email.com</em>"/>
                                    e-mail címre küldhetitek a visszaigazolást. <br>
                                    Még annyit szeretnék elmondani, hogy: <br>
                                    <input type="text" class="formText" value="" name="megjegyzes" placeholder="Szeretem a maceszgombócot!" />
                                    <br>
                                    Köszi szépen!
                                    <div class="nl-submit-wrap">
                                        <button class="nl-submit" type="submit">Küldés</button>
                                    </div>
                                    <div class="nl-overlay"></div>
                                </form>

                            </div>
                        </div>
                        </div>
