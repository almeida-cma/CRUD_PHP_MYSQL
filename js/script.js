function openEditModal(id, name, email, phone) {
    document.getElementById('editModal').style.display = 'block';
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
