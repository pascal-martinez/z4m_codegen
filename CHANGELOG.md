# CHANGE LOG: Code Generator (z4m_codegen)

## Version 1.2, 2025-06-10
- CHANGE: the maximum text length is increased to 35 characters for the "Entity Name" input field
and to 50 characters for the "Input Name", "HTML Element ID Prefix", "Controller Name", and "SQL Table Name" input fields.
- BUG FIXING: The error message returned by the 'remove' controller action in the generated PHP code
incorrectly used the `$rowFound['id']` variable instead of the `$request->id` variable.
- BUG FIXING: the `w3-theme' CSS` class was directly applied to the datalist row ID instead of the `$color['tag']` PHP statement.
- BUG FIXING: unnecessary CSS styles were applied to the datalist header.

## Version 1.1, 2025-04-23
- BUG FIXING: the Datalist's header was not sticky.

## Version 1.0, 2024-12-16
First version.