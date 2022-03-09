# README #

### What is this repository for? ###

A simple list field-type for Pyrocms 3 that allows you to add dynamic lists to items without end users breaking the layout.

Reorder, Add more lines, remove them

### How do I use this? ###

Returns an array of values
{{ visiosoft.field_type.list.values }}

Returns the number of list items
{{ visiosoft.field_type.list.count }}

# Configuration

Below is the full configuration available with defaults.

    protected $fields = [
        "example" => [
            "type"   => "emange.field_type.list",
            "config" => [
                "min" => null,
                "max" => null
            ]
        ]
    ];

<hr>

<a name="basic"></a>
## Basic Configuration

### Default Value

    "default_type" => "text"

The `default_value` allows you to set the input type for validation. Supports text and email.

<hr>

# Usage

## Setting Values

You must set the list field type value with a value or values from the available options.

    $entry->example = "foo";

You can set multiple values with an array.

    $entry->example = ["foo", "bar"];

<hr>

<a name="output"></a>
## Basic Output

The list field type returns an array of values.

    $entry->example->values; // ["foo", "bar"];