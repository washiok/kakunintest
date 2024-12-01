<?php
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

session_start();
$username = $_SESSION['name'];
if (isset($_SESSION['id'])) {//ログインしているとき
    $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login.blade.php">ログイン</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>

    <div class="search-name_item">
    <input type="text" name="name" value="">
    </div>
    <select name="sex">
            <option value=""></option>
            <?php
            foreach($sex as $sex){
                echo '<option value="'.$sex.'">'.$sex.'</option>';
            }
            ?>
    <select name="select">
            <option value=""></option>
            <?php
            foreach($select as $select){
                echo '<option value="'.$select.'">'.$select.'</option>';
            }
            ?>
            <div class="search-date_item">
            <input type="date" name="date" value="">
    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
    <div class="reset-form__button">
      <button class="reset-form__button-submit" type="submit">リセット</button>
    </div>
    <div class="export-form__button">
      <button class="export-form__button-submit" type="submit">エクスポート</button>
    </div>
  </form>
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">お名前</th>
        <th class="todo-table__header">性別</th>
        <th class="todo-table__header">メールアドレス</th>
        <th class="todo-table__header" colspan="2">お問い合わせの種類</th>
      </tr>
      <?php
      @foreach($contacts as $contact)
            <tr class="table-inner">
                <td class="name">
                    {{ $contact['last_name'] }}
                    <span class="space"></span>
                    <span class="first">{{ $contact['first_name'] }}</span>
                </td>
                <td class="gender">
                    <input type="hidden" value="{{ $contact['gender'] }}" />
                    <?php
                    if ($contact['gender'] == '1') {
                        echo '男性';
                    } elseif ($contact['gender'] == '2') {
                        echo '女性';
                    } else {
                        echo 'その他';
                    }
      ?>
                </td>
                <td class="address">
                    {{ $contact['email']}}
                </td>
                <td class="category">
                    {{ $contact['category']['content']}}
                </td>
                <td class="detail-button">
                    <button wire:click="openModal()" type="button" class="detail">詳細</button>
                    @if($showModal)
                    <div class="modal-wrapper">
                        <div class="modal-window">
                            <button wire:click="closeModal()" type="button" class="modal-close">
                            </button>
                            <table class="modal__content">
                                <tr class="modal-inner">
                                    <th class="modal-ttl">お名前</th>
                                    <td class="modal-data">
                                        {{ $contact['name'] }}
                                        <span class="space"></span>
                                    </td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">性別</th>
                                    <td class="modal-data">
                                        <input type="hidden" value="{{ $contact['gender'] }}" />
                                        <?php
                                        if ($contact['gender'] == '1') {
                                            echo '男性';
                                        } elseif ($contact['gender'] == '2') {
                                            echo '女性';
                                        } else {
                                            echo 'その他';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">メールアドレス</th>
                                    <td class="modal-data">{{ $contact['email'] }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">電話番号</th>
                                    <td class="modal-data">{{ $contact['tell'] }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">住所</th>
                                    <td class="modal-data">{{ $contact['address'] }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">建物名</th>
                                    <td class="modal-data">{{ $contact['building'] }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">お問い合わせの種類</th>
                                    <td class="modal-data">{{ $contact['category']['content'] }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl--last">お問い合わせ内容</th>
                                    <td class="modal-data--last">
                                        {{ $contact['detail']}}
                                    </td>
                                </tr>
                            </table>
                            <form class="delete-form" action="/delete" method="post">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="id" value="{{ $contact['id'] }}" />
                                <button class="delete-btn">削除</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection