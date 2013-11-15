<div id=tab-citta>
        <ul>
            <li><a href="#tab-1"><h6>Citt&agrave; pi&ugrave; votate</h6></a></li>
            <li><a href="#tab-2"><h6>Ultime Citt&agrave; inserite</h6></a></li>
        </ul>
        <div id=tab-1>
            {section name=nr loop=$cittafeedback}
                <button class="button-menu-citta" idviaggio="{$cittafeedback[nr]->idviaggio}" citta="{$cittafeedback[nr]->nome|regex_replace:"/[\ \']/":''}">
                    <h6>{$cittafeedback[nr]->nome}</h6>
                    <span class="feedback-citta-laterale">
                        {$cittafeedback[nr]->feedback}
                    </span>
                </button>
            {/section}
        </div>
        <div id=tab-2>
            {section name=nr loop=$ultimecitta}
                <button class="button-menu-citta" idviaggio="{$ultimecitta[nr]->idviaggio}" citta="{$ultimecitta[nr]->nome|regex_replace:"/[\ \']/":''}">
                    <h6>{$ultimecitta[nr]->nome}</h6>
                        <span class="feedback-citta-laterale">
                            {$ultimecitta[nr]->feedback}
                        </span>
                </button>
            {/section}
        </div>
    </div>
<br>

<div id=tab-luogo>
    <ul>
        <li><a href="#tab-1"><h6>Luoghi pi&ugrave; votati</h6></a></li>
        <li><a href="#tab-2"><h6>Ultimi Luoghi inseriti</h6></a></li>
    </ul>
    <div id=tab-1>
        {section name=nr loop=$luogofeedback}
            <button class="button-menu-luogo" idviaggio="{$luogofeedback[nr]->idviaggio}" citta="{$luogofeedback[nr]->nomecitta|regex_replace:"/[\ \']/":''}" luogo="{$luogofeedback[nr]->nome|replace:' ':''}">
                <h6>{$luogofeedback[nr]->nome}</h6>
                    <span class="feedback-luogo-laterale">
                        {$luogofeedback[nr]->feedback}
                    </span>
            </button>
        {/section}
    </div>
    <div id=tab-2>
        {section name=nr loop=$ultimiluoghi}
            <button class="button-menu-luogo" idviaggio="{$ultimiluoghi[nr]->idviaggio}" citta="{$ultimiluoghi[nr]->nomecitta|regex_replace:"/[\ \']/":''}" luogo="{$ultimiluoghi[nr]->nome|replace:' ':''}">
                <h6>{$ultimiluoghi[nr]->nome}</h6>
                        <span class="feedback-luogo-laterale">
                            {$ultimiluoghi[nr]->feedback}
                        </span>
            </button>
        {/section}
    </div>
</div>