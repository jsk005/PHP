# PHP
PHP 와 Android 어플간에 데이터를 주고 받기 위한 기본적인 로그인 예제가 포함되어 있다.
수준은 현재 앱 개발 시 사용하는 코드가 포함되어 있다.

# PHP 코딩 가이드

> PHP로 된 코드를 작성할 때 원활한 소통을 위해 지켜야할 내용


### 1. 기본 코딩 표준
- 파일은 반드시<?php 와 <?= 태그로 시작해야 한다. 
- 파일 문자 인코딩은 BOM(Byte order Mark)없이 **UTF-8**만 사용해야 한다. 
- 코드는 들여쓰기(indenting)에 **스페이스 4칸**을 사용해야 한다. 탭을 사용하지 말라. 
- 비어 있지 않은 라인 끝에는 공백 문자가 없어야 한다.
- 줄 길이는 80자를 넘지 않는 것을 권장한다. 

- PHP 5.3 이후의 코드들은 반드시 네임스페이스 규칙을 따라야 한다. 
```php
<?php
// PHP 5.3 이후
namespace Vendor\Model;

class Foo
{
}
?>
```

### 예약어(Keywords)와 True/False/Null
- PHP 예약어는 소문자여야 한다.
- PHP 상수, true, false 및 null 은 반드시 소문자여야 한다.

### 네임 스페이스 및 사용 선언
- 네임스페이스가 존재할 때 namespace 선언 다음에 하나의 빈 라인이 있어야 한다.
- 선언 하나당 하나의 use 키워드가 있어야 한다.
- use 블록 뒤에 빈 줄이 하나 있어야 한다.


```php
<?php
namespace Vendor\Package;​

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

​class Foo extends Bar implements FooInterface
{    
    const VERSION = '1.0';

    const DATE_APPROVED = '2023-03-15';

    public function sampleMethod($a, $b = null)
    {
        if ($a === $b) {
	    bar();
	} elseif ($a > $b) {
	    $foo->bar($arg1);
	} else {
	    BazClass::bar($arg2, $arg3);
	}    
    }​    
    
    final public static function bar()
    {        
        // method body    
    }
}
```

### Class 및 메서드
- extends와 implements 키워드는 클래스 이름과 같은 라인에서 선언되어야 한다.
- 존재하는 경우, abstract와final 선언은 가시성 선언 앞에 와야 한다.
- static 선언은 가시성 선언 뒤에 와야 한다.
- 클래스 이름은 반드시 Studly caps를 따라야 한다. 
- 매서드 이름은 반드시 camelCase를 따라야 한다.
- 클래스 상수는 반드시 대문자와 언더바로만 선언해야 한다.
- 클래스에서 braces({})는 반드시 다음 줄에 추가한다.
- 메서드에서 braces는 반드시 다음 줄에 추가한다.
- 모든 메서드와 propertis에 반드시 visibility를 선언해야 한다.

```php
<?php
namespace Vendor\Package;

abstract class ClassName
{
    protected static $foo;
    abstract protected function zim();

    final public static function bar()
    {
        // method body
    }

}
```

#### 메서드 호출과 함수 호출
```php
<?php
bar();
$foo->bar($arg1);
Foo::bar($arg2, $arg3);

?>
```

### 제어문
- 제어 구조 키워드는 그 뒤에 하나의 공백을 가져야 한다. 메서드와 함수 호출을 해서는 안된다.
- 제어 구조의 여는 중괄호는 반드시 같은 줄에 있어야 하며, 닫는 중괄호는 본문 뒤의 다음 줄로 가야한다.
- 여는 괄호 뒤에 공백이 있으면 안된다.
- 닫는 괄호 앞에 공백이 있어서는 안된다.

```php
<?php
namespace Vendor\Package;

use FooInterface;
use BarClass as Bar;
use OtherVendor\OtherPackage\BazClass;

class Foo extends Bar implements FooInterface
{
    public function sampleMethod($a, $b = null)
    {
        if ($a === $b) {
            bar();
        } elseif ($a > $b) {
            $foo->bar($arg1);
        } else {
            BazClass::bar($arg2, $arg3);
        }
    }

    final public static function bar()
    {
        // method body
    }
}
```

#### if, elseif, else
- 괄호, 공백 및 중괄호의 배치에 유의하라.
- else와 elseif 중괄호는 동일한 행에 있다.

```php
<?php
if ($expr1) {
    // if body
} elseif ($expr2) {
    // elseif body
} else {
    // else body;
}
?>
```

#### switch, case
- case 문은 스위치에서 한 번 들여 쓰기되어야 한다.
- break 키워드 (또는 다른 종료 키워드)는 사례 본문과 동일한 수준에서 들여 쓰기되어야 한다.

```php
<?php
switch ($expr) {
    case 0:
        echo 'First case, with a break';
        break;
    case 1:
        echo 'Second case, which falls through';
        // no break
    case 2:
    case 3:
    case 4:
        echo 'Third case, return instead of break';
        return;
    default:
        echo 'Default case';
        break;
}
```

#### for 문
```php
<?php
for ($i = 0; $i < 10; $i++) {
    // for body
}
?>
```

#### foreach
```php
<?php
foreach ($iterable as $key => $value) {
    // foreach body
}
?>
```

#### while
```php
<?php
while ($expr) {
    // structure body
}
```

#### do while
- PHP 로만 구성된 파일에서는 마지막에 ?> 을 생략해도 된다.

```php
<?php
do {
    // structure body;
} while ($expr);
```
