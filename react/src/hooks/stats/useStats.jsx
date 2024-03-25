import { useState } from 'react';
import StatsService from '@/services/stats/StatsService';

export default function useStats() {
    const [statsHome, setStatsHome] = useState({});
    const [statsStations, setStatsStations] = useState({});
    const [statsSlots, setStatsSlots] = useState({});
    const [statsBikes, setStatsBikes] = useState({});

    const getDashboardHome = () => {
        StatsService.getDashboardHome().then(({ data }) => {
            setStatsHome(data);
        }).catch(e => {
            console.error(e);
        });
    }

    const getDashboardStations = () => {
        StatsService.getDashboardStations().then(({ data }) => {
            setStatsStations(data);
        }).catch(e => {
            console.error(e);
        });
    }

    const getDashboardSlots = () => {
        StatsService.getDashboardSlots().then(({ data }) => {
            setStatsSlots(data);
        }).catch(e => {
            console.error(e);
        });
    }

    const getDashboardBikes = () => {
        StatsService.getDashboardBikes().then(({ data }) => {
            setStatsBikes(data);
        }).catch(e => {
            console.error(e);
        });
    }

    return { statsHome, statsStations, statsSlots, statsBikes, getDashboardHome, getDashboardStations, getDashboardSlots, getDashboardBikes };

}