import React, { useState } from 'react';
import ModalChangeData from '@/components/admin/controlUsers/modalChangeData/modalChangeData';
import DisableAccount from '@/components/admin/controlUsers/disableAccount/disableAccount';
import NotificationModal from '@/components/admin/controlUsers/notificationModal/notificationModal';

const users = [
  { id: 1, username: 'user1', email: 'user1@example.com', userType: 'Admin', isActive: true },
  { id: 2, username: 'user2', email: 'user2@example.com', userType: 'User', isActive: false },
];

const ControlUsers = () => {
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [isDisableModalOpen, setIsDisableModalOpen] = useState(false);
  const [isNotificationModalOpen, setIsNotificationModalOpen] = useState(false);
  const [currentUser, setCurrentUser] = useState(null);

  const handleEditUser = (user) => {
    setCurrentUser(user);
    setIsEditModalOpen(true);
  };

  const handleDisableUser = (user) => {
    setCurrentUser(user);
    setIsDisableModalOpen(true);
  };

  const handleOpenNotificationModal = (user) => {
    setCurrentUser(users.find(u => u.id === user));
    setIsNotificationModalOpen(true);
  };

  const handleCloseEditModal = () => {
    setIsEditModalOpen(false);
  };

  const handleCloseDisableModal = () => {
    setIsDisableModalOpen(false);
  };

  const handleCloseNotificationModal = () => {
    setIsNotificationModalOpen(false);
  };

  const handleUpdateUser = (userId, updatedFields) => {
    console.log('Actualizar los datos del usuario:', userId, updatedFields);
    setIsEditModalOpen(false);
  };

  const handleConfirmDisable = (userId) => {
    console.log('Desactivar la cuenta del usuario con id:', userId);
    setIsDisableModalOpen(false);
  };

  const handleNotificationSend = (notificationData) => {
    console.log('Enviar notificación con los datos:', notificationData, 'al usuario:', currentUser.username);
    setIsNotificationModalOpen(false);
  };

  return (
    <div className="min-h-screen p-4">
      {isEditModalOpen && (
        <ModalChangeData
          isOpen={isEditModalOpen}
          onClose={handleCloseEditModal}
          user={currentUser}
          onUpdate={handleUpdateUser}
        />
      )}

      {isDisableModalOpen && (
        <DisableAccount
          isOpen={isDisableModalOpen}
          onClose={handleCloseDisableModal}
          onConfirm={() => handleConfirmDisable(currentUser.id)}
          username={currentUser.username}
        />
      )}

      {isNotificationModalOpen && (
        <NotificationModal
          isOpen={isNotificationModalOpen}
          onClose={handleCloseNotificationModal}
          onSend={handleNotificationSend}
        />
      )}
      <div className="overflow-x-auto">
        <table className="min-w-full bg-white shadow rounded-lg">
          <thead className="bg-green-500 text-white">
            <tr>
              <th className="p-4 text-left uppercase">Estado</th>
              <th className="p-4 text-left uppercase">Username</th>
              <th className="p-4 text-left uppercase">Email</th>
              <th className="p-4 text-left uppercase">Tipo de Usuario</th>
              <th className="p-4 text-left uppercase">Estado Texto</th>
              <th className="p-4 text-left uppercase">Controles</th>
            </tr>
          </thead>
          <tbody>
            {users.map(user => (
              <tr key={user.id} className="border-b border-gray-200 hover:bg-gray-50">
                <td className="p-4">
                  <span className={`inline-block w-3 h-3 rounded-full ${user.isActive ? 'bg-green-500' : 'bg-orange-500'}`}></span>
                </td>
                <td className="p-4">{user.username}</td>
                <td className="p-4">{user.email}</td>
                <td className="p-4">{user.userType}</td>
                <td className="p-4">
                  {user.isActive ? 'Activo' : 'Desactivado'}
                </td>
                <td className="p-4">
                  <div className="flex space-x-2">
                    <button className="text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition duration-300" onClick={() => handleOpenNotificationModal(user.id)}>
                      Notificar
                    </button>
                    <button className="text-sm bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded transition duration-300" onClick={() => handleEditUser(user)}>
                      Editar
                    </button>
                    <button className="text-sm bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded transition duration-300" onClick={() => handleDisableUser(user)}>
                      Deshabilitar
                    </button>
                  </div>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ControlUsers;
