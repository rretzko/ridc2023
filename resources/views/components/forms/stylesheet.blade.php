
<style>
    form{padding: 0.5rem;}
    label{font-weight; bold;}
    .hint{margin-top: 0.5rem; margin-left: 0.5rem; font-size: smaller;}
    .input-group{display: flex; flex-direction: column; margin-bottom: 0.5rem;}
    .col2row{display: flex; flex-direction: column; margin-bottom: 1px;}
    .col2row select{margin-bottom: 2px;}
    input[type=text]{max-width: 10rem;}
    input[type=text].long-text{width: 20rem; max-width: 18rem;}
    input[type=text].short-text{width: 8rem; max-width: 8rem;}
    input[type=number].short-text{width: 8rem; max-width: 8rem;}
    input[type=email]{width: 20rem; max-width: 18rem;}

    @media only screen and (min-width: 800px)
    {
        .col2row{margin-bottom: 0; margin-right: 2px; flex-direction: row;}
        .col2row input, .col2row select{margin-bottom: 0; margin-right: 2px;}
        .hint{margin-left: 0.1rem; margin-right: 0.5rem;}
        .error-mssg{font-size:small; color:red;}
    }
</style>
