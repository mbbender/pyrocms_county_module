<div class="content">

<h2>{{ template:title }}</h2>

{{ if counties.total > 0 }}
<div id="county">
    <h3>{{ helper:lang line="county:questions" }}</h3>
    {{ pagination:links }}
    <div id="questions">
        <ol>
            {{ counties.entries }}
            <li>{{ url:anchor segments="county/#{{ id }}" title="{{ question }}" class="question" }}</li>
            {{ /counties.entries }}
        </ol>
    </div>
    <div id="answers">
        <h3>{{ helper:lang line="county:answers" }}</h3>
        <ol> 
            {{ counties.entries }}
            <li class="answer">
                <h4 id="{{ id }}">{{ question }}</h4>
                <p>{{ answer }}</p>
            </li>
            {{ /counties.entries }}
        </ol>
    </div>
</div>
{{ else }}
<h4>{{ helper:lang line="county:no_counties" }}</h4>
{{ endif }}

</div>