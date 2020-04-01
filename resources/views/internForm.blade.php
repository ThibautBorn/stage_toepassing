@extends('layout')
@section('content')
<style>
    .collapsible {
        background-color:#08a7eb ;
        color: white;
        cursor: pointer;
        padding: 18px;
        margin-top: 0.3em;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .active, .collapsible:hover {
        background-color:#1d8db0;
    }

    .collapsible:after {
        content: '\002B';
        color: white;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }

    .content {
        padding: 0 18px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        background-color: #f1f1f1;
    }
</style>
<div class="container">
    <H1>Form</H1>
    <form method="POST" action="{{ route('company') }}">
        @csrf

        @if (!$errors->isEmpty())
            <div class="alert alert-danger" role="alert">
                <p><strong>inzending niet geslaagd!</strong> niet alle verplichte velden zijn correct ingevuld.</p>
            </div>
        @endif
        <H2>Bedrijf</H2>
        <label for="org_name">Organisatie:</label><br>
        <input class="input is-danger" type="text" name="org_name" value="{{old('org_name')}}"><br>
        <label for="dep_name">departement (optioneel):</label><br>
        <input type="text" name="dep_name" value="{{old('dep_name')}}"><br>
        <label for="descr">geef een beschrijving van je bedrijf:</label><br>
        <textarea rows="4" cols="50" name="descr" value="{{old('descr')}}">Enter text here...</textarea><br>

        <H3>adres</H3>

        <label for="street">street:</label><br>
        <input type="text" name="street" value="{{old('street')}}"><br>
        <label for="number">nummer en bus:</label><br>
        <input type="text" name="number" value="{{old('number')}}"><br>

        <label for="municipality">Gemeente</label><br>
        <input type="text" name="municipality" value="{{old('municipality')}}"><br>
        <label for="zip">Postcode</label><br>
        <input type="number" name="zip" value="{{old('zip')}}"><br>

        <H2>informatie verantwoordelijke</H2>
        <label for="ad_name">naam</label><br>
        <input type="text" name="ad_name" value="{{old('ad_name')}}"><br>
        <label for="ad_func">functie</label><br>
        <input type="text" name="ad_func"  value="{{old('ad_func')}}"><br>

        <label for="ad_mail">mail</label><br>
        <input type="email" name="ad_mail" value="{{old('ad_mail')}}"><br>
        <label for="ad_tel">telefoon-nummer</label><br>
        <input type="text" name="ad_tel" value="{{old('ad_tel')}}"><br>
        <br>
        <input class="btn btn-primary" type="submit" value="Submit"><br>
        <br>
    </form>
    <div id="stages">
        <h2>Stages</h2>
        <button id="add_internship"class="btn btn-secondary" onclick="myFunction()">
            voeg een stage toe<i class="material-icons">add</i>
        </button>

        <button class="collapsible">stage</button>
        <div class="content">
            <label for="title">titel:</label><br>
            <input class="input is-danger" type="text" name="title" value="{{old('title')}}"><br>
            <label for="intern_descr">geef een korte beschrijving van de stage:</label><br>
            <textarea rows="4" cols="50" name="intern_descr" value="{{old('intern_descr')}}">Enter text here...</textarea><br>
            <label for="wanted_profile">geef een korte beschrijving van de stage:</label><br>
            <textarea rows="4" cols="50" name="wanted_profile" value="{{old('wanted_profile')}}">Enter text here...</textarea><br>
            <label for="additional_information">extra informatie:</label><br>
            <textarea rows="4" cols="50" name="additional_information" value="{{old('additional_information')}}">Enter text here...</textarea><br>

            <input type="checkbox" name="first_semester" value="true">
            <label for="first_semester"> Kan de stage in het eerste semester gedaan worden?</label><br>

            <input type="checkbox" name="project" value="true">
            <label for="project"> Kan de stage gecombineerd worden met een onderzoek/afstudeerproject?</label><br>

            <H3>stage mentor</H3>
            <label for="mentor_name">naam</label><br>
            <input type="text" name="mentor_name" value="{{old('mentor_name')}}"><br>
            <label for="mentor_func">functie</label><br>
            <input type="text" name="mentor_func"  value="{{old('mentor_func')}}"><br>

            <label for="mentor_mail">mail</label><br>
            <input type="text" name="mentor_mail" value="{{old('mentor_mail')}}"><br>
            <label for="mentor_tel">telefoon-nummer</label><br>
            <input type="text" name="mentor_tel" value="{{old('mentor_tel')}}"><br>
        </div>
</div>

    <!--
    <button class="collapsible">Open Section 2</button>
    <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    -->
</div>

<script>

    reload()

    function myFunction() {
        var x = document.getElementById("stages")
        var knop = document.createElement('button');
        knop.setAttribute("class","collapsible");
        knop.innerHTML =  "stage";
        x.append(knop);



        var stageform = document.createElement('div'); // Create New Element Form
        stageform.setAttribute("class","content");
        x.append(stageform)


        reload()

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //titel form

        var titlelabel = document.createElement('label');
        titlelabel.innerHTML = "Titel van stage:";
        titlelabel.setAttribute("for","title");
        stageform.appendChild(titlelabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var titleinput = document.createElement('input');
        titleinput.setAttribute("class", "input is-danger");
        titleinput.setAttribute("type", "text");
        titleinput.setAttribute("name", "title");
        stageform.appendChild(titleinput);

        //description
        var descriptionlabel = document.createElement('label');
        descriptionlabel.innerHTML = "geef een korte beschrijving van de stage:";
        descriptionlabel.setAttribute("for","intern_descr");
        stageform.appendChild(descriptionlabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var descriptiontextarea = document.createElement('textarea');
        descriptiontextarea.setAttribute("rows", "4");
        descriptiontextarea.setAttribute("name", "intern_descr");
        stageform.appendChild(descriptiontextarea);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //wanted_profile
        var profilelabel = document.createElement('label');
        profilelabel.innerHTML = "Geef een korte beschrijving van een gewenste kandidaat:";
        profilelabel.setAttribute("for","wanted_profile");
        stageform.appendChild(profilelabel);


        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var profiletextarea = document.createElement('textarea');
        profiletextarea.setAttribute("rows", "4");
        profiletextarea.setAttribute("name", "wanted_profile");
        stageform.appendChild(profiletextarea);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //additional_information
        var infolabel = document.createElement('label');
        infolabel.innerHTML = "Geef nog bijkomende info mee (optioneel):";
        infolabel.setAttribute("for","additional_information");
        stageform.appendChild(infolabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var infotextarea = document.createElement('textarea');
        infotextarea.setAttribute("rows", "4");
        infotextarea.setAttribute("name", "additional_information");
        stageform.appendChild(infotextarea);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //first_semester
        var semesterinput = document.createElement('input');
        semesterinput.setAttribute("type", "checkbox");
        semesterinput.setAttribute("value", "true");
        stageform.appendChild(semesterinput);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var semesterlabel = document.createElement('label');
        semesterlabel.innerHTML = "Kan de stage in het eerste semester gedaan worden?";
        semesterlabel.setAttribute("for","first_semester");
        stageform.appendChild(semesterlabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //project
        var projectinput = document.createElement('input');
        projectinput.setAttribute("type", "checkbox");
        projectinput.setAttribute("value", "true");
        stageform.appendChild(projectinput);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var projectlabel = document.createElement('label');
        projectlabel.innerHTML = "Kan de stage gecombineerd worden met een onderzoek/afstudeerproject?";
        projectlabel.setAttribute("for","project");
        stageform.appendChild(projectlabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //mentor
        var mentortitle = document.createElement('h3');
        mentortitle.innerHTML = "stage mentor";
        stageform.append(mentortitle)

        //mentor name
        var namelabel = document.createElement('label'); // Create Label for Name Field
        namelabel.innerHTML = "naam:"; // Set Field Labels
        namelabel.setAttribute("for","mentor_name");
        stageform.appendChild(namelabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var nameinput = document.createElement('input'); // Create Input Field for Name
        nameinput.setAttribute("class", "input is-danger");
        nameinput.setAttribute("type", "text");
        nameinput.setAttribute("name", "mentor_name");
        stageform.appendChild(nameinput);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //mentor_funct
        var functionlabel = document.createElement('label'); // Create Label for Name Field
        functionlabel.innerHTML = "functie:"; // Set Field Labels
        functionlabel.setAttribute("for","mentor_funct");
        stageform.appendChild(functionlabel);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        var functioninput = document.createElement('input'); // Create Input Field for Name
        functioninput.setAttribute("class", "input is-danger");
        functioninput.setAttribute("type", "text");
        functioninput.setAttribute("name", "mentor_funct");
        stageform.appendChild(functioninput);

        var linebreak = document.createElement('br');
        stageform.appendChild(linebreak);

        //mentor_mail
        var maillabel = document.createElement('label'); // Create Label for Name Field
        maillabel.innerHTML = "mail:"; // Set Field Labels
        maillabel.setAttribute("for","mentor_mail");
        stageform.appendChild(maillabel);

        stageform.appendChild(linebreak);

        var mailinput = document.createElement('input'); // Create Input Field for Name
        mailinput.setAttribute("class", "input is-danger");
        mailinput.setAttribute("type", "text");
        mailinput.setAttribute("name", "mentor_mail");
        stageform.appendChild(mailinput);

        stageform.appendChild(linebreak);

        //mentor_tel
        var telelabel = document.createElement('label'); // Create Label for Name Field
        telelabel.innerHTML = "telefoon:"; // Set Field Labels
        telelabel.setAttribute("for","mentor_tel");
        stageform.appendChild(telelabel);

        stageform.appendChild(linebreak);

        var teleinput = document.createElement('input'); // Create Input Field for Name
        teleinput.setAttribute("class", "input is-danger");
        teleinput.setAttribute("type", "text");
        teleinput.setAttribute("name", "mentor_tel");
        teleinput.appendChild(teleinput);

        stageform.appendChild(linebreak);


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }

    //setInterval(reload,100);

    function reload() {
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
    }

    }
</script>
@endsection
