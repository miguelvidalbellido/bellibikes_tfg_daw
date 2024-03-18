import React, { useState, useEffect } from 'react';
import ModalChangeData from '@/components/admin/controlUsers/modalChangeData/modalChangeData';
import DisableAccount from '@/components/admin/controlUsers/disableAccount/disableAccount';
import NotificationModal from '@/components/admin/controlUsers/notificationModal/notificationModal';
import { useAuth } from '@/hooks/auth/useAuth';

const ControlUsers = () => {
  
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [isDisableModalOpen, setIsDisableModalOpen] = useState(false);
  const [isNotificationModalOpen, setIsNotificationModalOpen] = useState(false);
  const [currentUser, setCurrentUser] = useState(null)
  const { userAllAdmin, useGetAllUsers, useEditUser, useNotifyUserMail } = useAuth();

  useEffect(() => {
    useGetAllUsers()
  }, []);

  const handleEditUser = (user) => {
    setCurrentUser(user);
    setIsEditModalOpen(true);
  };

  const handleDisableUser = (user) => {
    setCurrentUser(user);
    setIsDisableModalOpen(true);
  };

  const handleOpenNotificationModal = (userId) => {
    setCurrentUser(userAllAdmin.find(u => u.id === userId));
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
    const username = userAllAdmin.find(u => u.id === userId).username;

    console.log(updatedFields);
    const data = {
      'username': username,
      'email': updatedFields.email,
      'password': updatedFields.password,
      'type': updatedFields.userType
    }

    useEditUser(data);
    
    setIsEditModalOpen(false);
  };

  const handleConfirmDisable = (username) => {
    console.log('Desactivar la cuenta del usuario con id:', username);
    setIsDisableModalOpen(false);
  };

  const handleNotificationSend = (notificationData) => {
    console.log(notificationData);
    // Añade al campo to el email del usuario seleccionado
    notificationData.to = currentUser.email;
    useNotifyUserMail(notificationData);
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
          onConfirm={() => handleConfirmDisable(currentUser.username)}
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
            {userAllAdmin.map(user => (
              <tr key={user.id} className="border-b border-gray-200 hover:bg-gray-50">
                <td className="p-4">
                  <span className={`inline-block w-3 h-3 rounded-full ${user.isActive ? 'bg-green-500' : 'bg-orange-500'}`}></span>
                </td>
                <td className="p-4">{user.username}</td>
                <td className="p-4">{user.email}</td>
                <td className="p-4">{user.type}</td>
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
