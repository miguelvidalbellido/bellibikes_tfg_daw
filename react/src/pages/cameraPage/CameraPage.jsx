import React, { useState } from "react";
import Webcam from "react-webcam";
import {
  FiCamera,
  FiCameraOff,
  FiRotateCcw,
  FiCheck,
  FiEdit,
  FiMapPin
} from "react-icons/fi";
import LocationModal from "@/components/client/camera/locationModal/LocationModal";
import DescriptionModal from "@/components/client/camera/descriptionMolal/descriptionModal";
import { useToast } from "@/components/ui/use-toast";
const videoConstraints = {
  facingMode: "user",
};
import { useNavigate } from "react-router-dom";

const CameraPage = () => {
  const [facingMode, setFacingMode] = useState("user");
  const [photoTaken, setPhotoTaken] = useState(false);
  const [imageSrc, setImageSrc] = useState(null);
  const webcamRef = React.useRef(null);
  const { toast } = useToast();
  const navigate = useNavigate();

  // FUNCION AUXILIAR REDIRECT
  const redirect = () => {
    navigate("/");
  }

  // FUNCION AUXILIAR TOASTER
  const toastLauncher = (title, msg, status) => {
    toast({
      title: title,
      description: msg,
      status: status,
      duration: 5000
    });
  }

  // UBICACIÓN
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [location, setLocation] = useState('');

  const handleOpenModalUbication = () => {
    setIsModalOpen(true);
  };

  const handleCloseModalUbication = () => {
    setIsModalOpen(false);
  };

  const handleAddLocation = (newLocation) => {
    setLocation(newLocation);
    handleCloseModalUbication();
  };

  // END_UBICACIÓN

  // DESCRIPCIÓN

  const [isModalOpenDescription, setIsModalOpenDescription] = useState(false);
  const [description, setDescription] = useState('');

  const handleOpenModalDescription = () => {
    setIsModalOpenDescription(true);
  };

  const handleCloseModalDescription = () => {
    setIsModalOpenDescription(false);
  };

  const handleAddDescription = (newDescription) => {
    setDescription(newDescription);
    handleCloseModalDescription(); // Cierra el modal
  };

  // END_DESCRIPCIÓN


  // CONTROL CAMERA
  const flipCamera = () => {
    setFacingMode((prevMode) => (prevMode === "user" ? "environment" : "user"));
  };

  const takePhoto = () => {
    if (webcamRef.current.getScreenshot() === null) {
      toastLauncher("Error", "No se ha podido tomar la foto", "error");
      return;
    };
    setImageSrc(webcamRef.current.getScreenshot());
    console.log(imageSrc);
    setPhotoTaken(true);
  };

  const closeCamera = () => {
    redirect();
  };

  const handleConfirmPhoto = () => {
    console.log({ imageSrc, description, location });
  };

  // END_CONTROL_CAMERA


  

  const CAMERA_VIEW = !photoTaken ? (
    <div className="fixed inset-0 z-10 flex flex-col items-center justify-center bg-gray-500">
      <Webcam
        audio={false}
        ref={webcamRef}
        screenshotFormat="image/jpeg"
        videoConstraints={{ ...videoConstraints, facingMode }}
        className="w-full h-full"
      />
      <button
        onClick={closeCamera}
        className="absolute top-4 left-4 z-20 bg-red-500 text-white p-2 rounded-full"
      >
        <FiCameraOff className="text-2xl" />
      </button>
      <div className="absolute bottom-10 w-full flex justify-center items-center z-20">
        <button
          onClick={flipCamera}
          className="absolute left-4 bg-green-500 text-white p-3 rounded-full"
        >
          <FiRotateCcw className="text-2xl" />
        </button>
        <button
          onClick={takePhoto}
          className="bg-blue-500 text-white p-4 rounded-full"
        >
          <FiCamera className="text-3xl" />
        </button>
      </div>
    </div>
  ) : (
    <div className="fixed inset-0 z-10 flex flex-col items-center justify-center bg-gray-500">
      <LocationModal isOpen={isModalOpen} onClose={handleCloseModalUbication} onAddLocation={handleAddLocation} />
      <DescriptionModal isOpen={isModalOpenDescription} onClose={handleCloseModalDescription} onAddDescription={handleAddDescription} />
      <div className="absolute top-4 right-4 flex gap-2">
        <button
          onClick={handleOpenModalDescription}
          className="bg-yellow-500 text-white p-2 rounded-full"
        >
          <FiEdit className="text-2xl" />
        </button>
        <button
          onClick={handleOpenModalUbication} 
          className="bg-red-500 text-white p-2 rounded-full"
        >
          <FiMapPin className="text-2xl" />{" "}
        </button>
      </div>
      <img src={imageSrc} alt="Captured" className="max-w-full max-h-3/4" />
      <div className="flex justify-center items-center gap-4 mt-6">
        <button
          onClick={handleConfirmPhoto}
          className="bg-green-500 text-white p-2 rounded-full"
        >
          <FiCheck className="text-4xl" />
        </button>
      </div>
    </div>
  );

  return <div>{CAMERA_VIEW}</div>;
};

export default CameraPage;
