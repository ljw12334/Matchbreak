function existing_id() {
    const id = document.getElementById('user_id').value;
    const formData = new FormData();
        formData.append('user_id', id);

        fetch('signup_id_check.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('서버 오류: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('에러 발생:', error);
                alert('신청 중 오류가 발생했습니다: ' + error.message);
            });
}
