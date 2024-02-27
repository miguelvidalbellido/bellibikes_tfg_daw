import React, { useEffect, useContext, useState } from 'react';
import BikeRentalDetails from '@/components/client/rent/BikeRentalDetails';
import { useParams } from "react-router-dom";
import { useRent } from '@/hooks/rent/useRent';
import { useNavigate } from "react-router-dom";

const DataFinishRent = () => {
  const { uuidRent } = useParams();
  const { rentDetails, getDataRent } = useRent();
  const navigate = useNavigate();

  useEffect(() => {
    if (uuidRent) getDataRent(uuidRent)
  }, [uuidRent]);

  const handleOpenIssue = () => {
    navigate('/reportIncident', {state: {origin: 'endRent', uuid: rentDetails.uuid_bike}});
  };

  return (
    <BikeRentalDetails dataRent={rentDetails} onOpenIssue={handleOpenIssue} />
  );
};

export default DataFinishRent;
