
prowlphp_wrapper
================

Wraps [xenji's ProwlPHP library](https://github.com/xenji/ProwlPHP) with a simpler interface.


## Example

	$prowl = new Prowl\Wrapper(array('xxxyyyzzz'), 'My app');
	$prowl->push('My event', 'A very long event description', 'http://example.com/optional_url');
