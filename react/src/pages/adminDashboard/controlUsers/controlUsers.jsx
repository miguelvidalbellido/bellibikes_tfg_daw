import React, { useState, useEffect } from "react";
import ModalChangeData from "@/components/admin/controlUsers/modalChangeData/modalChangeData";
import DisableAccount from "@/components/admin/controlUsers/disableAccount/disableAccount";
import NotificationModal from "@/components/admin/controlUsers/notificationModal/notificationModal";
import EnableAccount from '@/components/admin/controlUsers/enableAccount/EnableAccount'

import { useAuth } from "@/hooks/auth/useAuth";

const ControlUsers = () => {
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [isDisableModalOpen, setIsDisableModalOpen] = useState(false);
  const [isEnableModalOpen, setIsEnableModalOpen] = useState(false);
  const [isNotificationModalOpen, setIsNotificationModalOpen] = useState(false);
  const [currentUser, setCurrentUser] = useState(null);
  const { userAllAdmin, useGetAllUsers, useEditUser, useNotifyUserMail, useDisableAccount, useEnableAccount } = useAuth();

  useEffect(() => {
    useGetAllUsers();
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
    setCurrentUser(userAllAdmin.find((u) => u.id === userId));
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
    const username = userAllAdmin.find((u) => u.id === userId).username;

    console.log(updatedFields);
    const data = {
      username: username,
      email: updatedFields.email,
      password: updatedFields.password,
      type: updatedFields.userType,
    };

    useEditUser(data);

    setIsEditModalOpen(false);
  };

  const handleConfirmDisable = (username) => {
    useDisableAccount({"username": username});
    setIsDisableModalOpen(false);
  };

  const handleNotificationSend = (notificationData) => {
    console.log(notificationData);
    notificationData.to = currentUser.email;
    useNotifyUserMail(notificationData);
    setIsNotificationModalOpen(false);
  };

  const handleEnableUser = (user) => {
    setCurrentUser(user);
    setIsEnableModalOpen(true); 
  };

  const handleCloseEnableModal = () => {
    setIsEnableModalOpen(false); 
  };

  const handleConfirmEnable = (username) => {
    useEnableAccount({"username": username});
    setIsEnableModalOpen(false);
  };

  const userTypes = {
    admin: "Administrador",
    client: "Usuario",
    maint: "Mantenimiento"
  }


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
      {isEnableModalOpen && (
        <EnableAccount
          isOpen={isEnableModalOpen}
          onClose={handleCloseEnableModal}
          onConfirm={() => handleConfirmEnable(currentUser.username)}
          username={currentUser.username}
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
            {userAllAdmin.map((user) => (
              <tr
                key={user.id}
                className={`border-b border-gray-200 ${
                  user.is_disabled ? "hover:bg-orange-50" : "hover:bg-green-50"
                }`}
              >
                <td className="p-4">
                  <span
                    className={`inline-block w-3 h-3 rounded-full ${
                      user.is_disabled ? "bg-orange-500" : "bg-green-500"
                    }`}
                  ></span>
                </td>
                <td className="p-4">{user.username}</td>
                <td className="p-4">{user.email}</td>
                <td className="p-4">{userTypes[user.type]}</td>
                <td className="p-4">
                  {user.is_disabled ? "Desactivado" : "Activado"}
                </td>
                <td className="p-4">
                  <div className="flex space-x-2">
                    <button
                      className="text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition duration-300"
                      onClick={() => handleOpenNotificationModal(user.id)}
                    >
                      Notificar
                    </button>
                    <button
                      className="text-sm bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded transition duration-300"
                      onClick={() => handleEditUser(user)}
                    >
                      Editar
                    </button>
                    {user.is_disabled ? (
                      <button
                        className="text-sm bg-purple-500 hover:bg-red-600 text-white py-2 px-4 rounded transition duration-300"
                        onClick={() => handleEnableUser(user)}
                      >
                        Activar
                      </button>
                    ) : (
                      <button
                        className="text-sm bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded transition duration-300"
                        onClick={() => handleDisableUser(user)}
                      >
                        Desactivar
                      </button>
                    )}
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
