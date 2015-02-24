	<?php
class ValidationException extends AppException
	{	
	
	}

class AppException extends Exception
	{	

	}

class RecordNotFoundException extends ValidationException
	{

	}

class NotFoundException extends AppException
	{
		
	}

?> 

