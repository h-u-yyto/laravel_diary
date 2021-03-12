$(document).on('click', '.js-like', function(){
    let diaryId = $(this).siblings('.diary-id').val();
    let $checkedBtn = $(this);

    // like処理 ajax
    like(diaryId, $checkedBtn)
});

function like(diaryId, $checkedBtn) {
    $.ajax({
        url: 'diary/' + diaryId + '/like',
        type: 'POST',
        dataType: 'json',
        // LaravelではCSRF対策として、tokenを送信しないとエラーが発生する
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(
        function (data) {
            // ボタンの色を変える
            changeLikeBtn($checkedBtn);

            // いいね数を1増やす
            let num = Number($checkedBtn.siblings('.js-like-num').text());
            $checkedBtn.siblings('.js-like-num').text(num + 1);
        },
        function () {
            console.log('error');
        }
    )
}


// いいね解除ボタンが押されたとき
$(document).on('click', '.js-dislike', function() {
    let diaryId = $(this).siblings('.diary-id').val();
  
    let $checkedBtn = $(this);
  
    dislike(diaryId, $checkedBtn);
  })
  
  
  // いいね解除処理
  function dislike(diaryId, $checkedBtn) {
    $.ajax({
        url: 'diary/' + diaryId +'/dislike',
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(
        function (data) {
            changeLikeBtn($checkedBtn);
  
            // いいね数を1減らす
            let num = Number($checkedBtn.siblings('.js-like-num').text());
            $checkedBtn.siblings('.js-like-num').text(num - 1);
        },
        function () {
            console.log(error);
        }
    )
  }

  // いいね, いいね解除でボタンの色を変更、
// js-like, js-dislikeでいいね, いいね解除の切り替えをしてるためクラスの付け替え
function changeLikeBtn(btn) {
    btn.toggleClass('far').toggleClass('fas');
    btn.toggleClass('js-like').toggleClass('js-dislike');
}