Feature: stingray
    In order to manipulate an array
    as a Developer
    I need to use dot notation

    Scenario Outline: read from array (boolean)
        Given a default array
        And a node alias "<node_alias>"
        Then it should pass constraint "<constraint>"

        Examples:
            |  node_alias                 |   constraint                                         |
            |  boolean.true               |   Symfony\Component\Validator\Constraints\True       |
            |  boolean.false              |   Symfony\Component\Validator\Constraints\False      |

    Scenario Outline: read from array (integer and floating point)
        Given a default array
        And a node alias "<node_alias>"
        Then it should be within "<min>" and "<max>"

        Examples:
            |  node_alias                 |   min     |   max     |
            |  integer.one                |   0       |   2       |
            |  integer.two                |   1       |   3       |
            |  integer.three              |   2       |   4       |            
            |  integer.float.decimal      |   1.2     |   1.3     |       
            |  integer.float.exponent.a   |   1.1e3   |   1.3e3   |
            |  integer.float.exponent.b   |   6E-10   |   8E-10   |

    Scenario Outline: read from array (string)
        Given a default array
        And a node alias "<node_alias>"
        Then it should pass constraint "<constraint>"

        Examples:
            |  node_alias                 |   constraint                                         |
            |  string.notblank            |   Symfony\Component\Validator\Constraints\NotBlank   |            
            |  string.blank               |   Symfony\Component\Validator\Constraints\Blank      |            
            |  string.null                |   Symfony\Component\Validator\Constraints\Null       |            

    Scenario Outline: write to array (boolean)
        Given a default array
        And a node alias "<node_alias>"
        And a new value "<value>"
        Then new value should pass constraint "<constraint>"

        Examples:
            |  node_alias                 |   constraint                                         |   value   |
            |  boolean.true               |   Symfony\Component\Validator\Constraints\False      |   false   |
            |  boolean.false              |   Symfony\Component\Validator\Constraints\True       |   true    |

    Scenario Outline: write to array (integer and floating point)
        Given a default array
        And a node alias "<node_alias>"
        And a new value "<value>"
        Then it should be within "<min>" and "<max>"

        Examples:
            |  node_alias                 |   min      |   max      |   value          |
            |  integer.one                |   -2       |   0        |   -1             |
            |  integer.two                |   -3       |   -1       |   -2             |
            |  integer.three              |   -4       |   -2       |   -3             |
            |  integer.float.decimal      |   -1.3     |   -1.2     |   -1.234567890   |  
            |  integer.float.exponent.a   |   -1.3e3   |   -1.1e3   |   -1.2e3         |
            |  integer.float.exponent.b   |   -8E-10   |   -6E-10   |   -7E-10         |

    Scenario Outline: read from array (string)
        Given a default array
        And a node alias "<node_alias>"
        And a new value "<value>"
        Then it should pass constraint "<constraint>"

        Examples:
            |  node_alias                 |   constraint                                         |   value       |
            |  string.notblank            |   Symfony\Component\Validator\Constraints\Blank      |               |            
            |  string.blank               |   Symfony\Component\Validator\Constraints\NotBlank   |   not_blank   |
            |  string.null                |   Symfony\Component\Validator\Constraints\NotNull    |   not_null    |
