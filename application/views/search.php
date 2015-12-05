<?php
//Load the header
$this->load->view('templates/header');
?>

<div class="h1wrap"><h1>Search</h1></div>

<div class="info">
	<p>Enter search terms to find specific messages</p>
</div>

<form id="searchForm" >
	<input type="text" id="query" />
	<button>Submit</button>
</form>


<script>
//Event listener to handle form submit
document.getElementById("searchForm").addEventListener("submit", function(e){
	//Prevent default submission method
    e.preventDefault();
    //Take the value from the field
    var query = document.getElementById("query").value;
    //Encode it by base64 and URL encode it
	query = encodeURIComponent(btoa(query));
	//Redirect to results page with encoded search terms
	window.location = "<?php echo base_url(); ?>search/dosearch?query=" + query;
});
</script>

<?php
//Load footer
$this->load->view('templates/footer');