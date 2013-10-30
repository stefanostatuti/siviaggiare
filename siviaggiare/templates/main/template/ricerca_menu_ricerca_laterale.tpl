<div id=tab-citta>
        <ul>
            <li><a href="#tab-1"><h6>Citt&agrave; pi&ugrave; votate<h6></a></li>
            <li><a href="#tab-2"><h6>Ultime Citt&agrave;<h6></a></li>
        </ul>
        <div id=tab-1>
            {section name=nr loop=$cittafeedback}
                <button class="button-menu-citta">
                    {$cittafeedback[nr]->nome}
                    <div class="feedback-citta-laterale">
                        {$cittafeedback[nr]->feedback}
                    </div>
                </button>
            {/section}
        </div>
    </div>