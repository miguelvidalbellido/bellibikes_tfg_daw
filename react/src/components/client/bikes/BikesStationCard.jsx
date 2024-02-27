import React from "react";
import bikeIcon from '@/assets/bikeIcons/bike.png'
import { data } from "autoprefixer";

const BikesStationCard = ({bike}) => {

  return (
    <>
      <div className="flex items-center justify-between p-4">
        <div className="flex items-center">
          <img src={bikeIcon} alt="Bike" className="h-12 mr-4" />
          <div>
            <h3 className="font-bold text-gray-800">{bike.sname}</h3>
            <p className="text-gray-500">{bike.brand} {bike.model}</p>
          </div>
        </div>
        <div className="text-right">
          <span className="text-gray-500 font-bold">{bike.batery}%</span>
          <button className="text-gray-500 hover:text-gray-700">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth={2}
                d="M9 5l7 7-7 7"
              />
            </svg>
          </button>
        </div>
      </div>
    </>
  );
};

export default BikesStationCard;
