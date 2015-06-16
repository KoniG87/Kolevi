

                    <div class="row">
                        <div class="eight columns">
                            <h3>[[DEARGUESTS]]</h3>

                            [[FOGLALAS_LEIRAS]]
                        </div>    
                        <div class="three columns right">
                            <img data-src="assets/img/asztalfoglalas-img.png" alt="Asztalfoglalás" class="lazy illusztracio">
                            <noscript>
                            	<img src="assets/img/asztalfoglalas-img.png" alt="Asztalfoglalás">
                           	</noscript>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="twelve columns">
                            <div class="foglalas-form">
                                

                                <form id="nl-form" action="requestHandler.php" class="nl-form" name="nl-form">
                                    <div class="nl-replace">
                                    
                                        <input type="hidden" name="request" value="asztalfoglalasUpdate"/>
                                        <input type="hidden" name="id" value="0"/>
                                        <h3>Asztalfoglalás</h3>
                                        Sziasztok! 
                                        <input type="text" name="nev" class="formText" value="" placeholder="XY" data-subline="Ide írd be a neved: <em>Vezetéknév</em> és <em>Keresztnév</em> is kell"/>
                                        vagyok és nagyon szeretnék
                                        <select name="hanyfo" required title="Tudnunk kell, hogy hányan jöttök.">
                                            <option value="1" selected >egy</option>
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
                                        
                                        <input type="text" class="formText" name="email" required value="" placeholder="Erre az " data-subline="pl: <em>vendeg@email.com</em>"/>
                                        e-mail címre küldhetitek a visszaigazolást. <br>
                                        Bármi van hívjatok fel telefonon a
                                        <input type="text" class="formText" name="tel" required value="" placeholder="Ezen a " data-subline="pl: <em>+36 12 3456 789</em>"/>
                                        számon. Még annyit szeretnék elmondani, hogy: <br>
                                        <input type="text" class="formText" value="" name="megjegyzes" placeholder="Szeretem a maceszgombócot!" data-subline="Ide jöhet bármi, amit még hozzá tennél az asztalfoglaláshoz"/>
                                        <br>
                                        Köszi szépen!
                                        <div class="nl-submit-wrap">
                                            <button class="nl-submit" type="submit">Küldés</button>
                                        </div>
                                        <div class="nl-overlay"></div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        </div>
