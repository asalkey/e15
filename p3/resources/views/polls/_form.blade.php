<form method="post" action="{{url('/poll')}}">
	@csrf
	<div class="form-group">
		<label for="question"> Question</label>
		<input type="text" name="question">
	</div>
	<div class="form-group">
		<label for="option1"> Option #1 </label>
		<input type="text" name="option[]">
    </div>
    <div class="form-group">
		<label for="option2"> Option #2</label>
		<input type="text" name="option[]">
	</div>	
    <div class="form-group">
		<label for="option3">Option #3</label>
		<input type="text" name="option[]">
    </div>
    <div class="form-group">
		<label for="option4">Option #4</label>
		<input type="text" name="option[]">
    </div>
	<input type="submit">
</form>
