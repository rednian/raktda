<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>RAKTDA | {{__('Terms and Conditions')}} </title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- ================== BEGIN BASE CSS STYLE ================== -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  
  <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <style>
    * {
        font-family: "Open Sans", sans-serif;
        box-sizing: border-box;
    }

    body {
        padding:0;
        margin:0;
    }

    .main {
        margin-top: 50px;
        margin-bottom: 50px;
        position:relative;
    }
    .heading {
        padding-bottom: 2rem;
        font-weight: bold;
    }

    .go_back_link {
        position: absolute;
        top: 30px;
        right:25px;
    }

    .content {
        font-size: 16px;    
        text-align: justify;
    }

    .content ul li {
        padding-bottom:1rem;
    }
  </style>
</head>

<body class=" bg-white">

    <div class="container main">
        <h2 class="heading"> 
            Terms and Conditions
        </h2>
        <a href="{{URL::signedRoute('company.create')}}" class="go_back_link">Go Back</a>
        <div class="content">
             <p>This page explains the terms and conditions which will be applied to all users and visitors of the portal. The portal usage may be stopped, and/or prevented, and/or ended in case of any violation on the part of any user or if there are good reasons to believe that any user has violated rules and conditions of usage.</p>
        <p>Users shall not be permitted to violate or attempt to violate the applicable procedures and regulations. Conditions include but are not limited to the following:</p>
        <ul>
            <li>Accessing details that are not intended to be provided to this user or logging into a server or an account that the user is not authorised to access.</li>
            <li>Attempting to conduct any test or survey for finding weakness of any system or network of the UAE Government or violating applicable procedures or documenting them without an official permit from the UAE Government.</li>
            <li>Attempting to interfere in the provided service on the part of any user, host or network including but not limited to placing a virus on the portal, increasing load to or immersing it, sending commercial messages to it or avalanching it with electronic messages or even destroying it.</li>
            <li>
                Sending unwanted electronic messages to the portal including commercials and/or advertisements on services or products or falsifying any dispatch control protocol package address/internet protocol or any part of the address details in any electronic message or sending news messages.
            </li>
            <li>Using this portal by any means for sending an email or announcing any untrue news or information and ascribing it to the UAE Government unrightfully.</li>
        </ul>
        <p>Violating rules of usage, system or network shall expose the person involved to civil and criminal liability. Cases of such violations shall be investigated and the person involved shall be legally prosecuted.</p>
        <p>
        The UAE Government portal does not bear or hold responsibility against any damages, costs and expenses, related to any violation of the conditions of using this portal by the user or by any other person acting on his behalf.
        </p>
        <p>
            The UAE Government portal reserves all rights to deny or restrict, modify or discontinue access to any particular feature/s that are part of the portal at any time, without enduring any responsibility or attributing reasons whatsoever.
        </p>
        <p>Users must visit this page from time to time to check the revised terms and conditions.</p>
        <p>Users are advised to observe the internal policies outlined in the portal with respect to its disclaimer, copyright and privacy policy. Any violation thereof shall result in the user bearing all consequences, direct and indirect.</p>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>