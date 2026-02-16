import './bootstrap';
import Alpine from 'alpinejs';
import { NeuralVoid } from './neural-void';
import { OmniTerminal } from './omni-terminal';
import { DashboardCharts } from './dashboard-charts';
import { renderTicker, startTickerScroll, startAutoRefresh } from './crypto-ticker';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', async () => {
    // Initialize Neural Void if canvas exists
    if (document.getElementById('neural-canvas')) {
        new NeuralVoid('neural-canvas');
    }

    // Initialize Omni Terminal if container exists
    if (document.getElementById('omni-terminal')) {
        new OmniTerminal('omni-terminal');
    }

    // Initialize Dashboard Charts if canvas exists
    if (document.getElementById('portfolio-chart')) {
        new DashboardCharts('portfolio-chart');
    }

    // Initialize Live Crypto Ticker (dashboard)
    if (document.getElementById('dash-ticker-content')) {
        await renderTicker('dash-ticker-content');
        startTickerScroll('dash-ticker-track', 'dash-ticker-content');
        startAutoRefresh('dash-ticker-content');
    }

    // Initialize Live Crypto Ticker (public pages)
    if (document.getElementById('pub-ticker-content')) {
        await renderTicker('pub-ticker-content');
        startTickerScroll('pub-ticker-track', 'pub-ticker-content');
        startAutoRefresh('pub-ticker-content');
    }
});
