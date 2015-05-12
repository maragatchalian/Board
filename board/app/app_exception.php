<?php

class AppException extends Exception
{	

}


class RecordNotFoundException extends ValidationException
{

}

class ValidationException extends AppException
{	
	
}

class NotIntegerException extends AppException
{

}
