/**
 * Live Crypto Ticker — CoinGecko Integration
 * Fetches real-time prices with localStorage caching (60s TTL).
 * Falls back to hardcoded data if API fails.
 */

const COINS = 'bitcoin,ethereum,solana,ripple,cardano,dogecoin,avalanche-2';
const CACHE_KEY = 'rat_crypto_ticker';
const CACHE_TTL = 60000; // 60 seconds

const SYMBOLS = {
    bitcoin: { sym: 'BTC', icon: '₿' },
    ethereum: { sym: 'ETH', icon: 'Ξ' },
    solana: { sym: 'SOL', icon: '◎' },
    ripple: { sym: 'XRP', icon: '✕' },
    cardano: { sym: 'ADA', icon: '₳' },
    dogecoin: { sym: 'DOGE', icon: 'Ð' },
    'avalanche-2': { sym: 'AVAX', icon: 'A' },
};

const FALLBACK = {
    bitcoin: { usd: 104287.50, usd_24h_change: 2.41 },
    ethereum: { usd: 2847.32, usd_24h_change: 1.87 },
    solana: { usd: 198.45, usd_24h_change: 5.23 },
    ripple: { usd: 2.89, usd_24h_change: 4.15 },
    cardano: { usd: 0.842, usd_24h_change: 1.23 },
    dogecoin: { usd: 0.312, usd_24h_change: -1.05 },
    'avalanche-2': { usd: 38.15, usd_24h_change: 3.67 },
};

function getCached() {
    try {
        const raw = localStorage.getItem(CACHE_KEY);
        if (!raw) return null;
        const { data, ts } = JSON.parse(raw);
        if (Date.now() - ts > CACHE_TTL) return null;
        return data;
    } catch { return null; }
}

function setCache(data) {
    try {
        localStorage.setItem(CACHE_KEY, JSON.stringify({ data, ts: Date.now() }));
    } catch { /* quota exceeded — ignore */ }
}

async function fetchPrices() {
    // Try cache first
    const cached = getCached();
    if (cached) return cached;

    try {
        const url = `https://api.coingecko.com/api/v3/simple/price?ids=${COINS}&vs_currencies=usd&include_24hr_change=true`;
        const res = await fetch(url);
        if (!res.ok) throw new Error(res.status);
        const data = await res.json();
        setCache(data);
        return data;
    } catch (err) {
        console.warn('[Ticker] CoinGecko fetch failed, using fallback:', err.message);
        return FALLBACK;
    }
}

function formatPrice(price) {
    if (price >= 1000) return '$' + price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    if (price >= 1) return '$' + price.toFixed(2);
    return '$' + price.toFixed(3);
}

function formatChange(change) {
    const sign = change >= 0 ? '+' : '';
    return sign + change.toFixed(2) + '%';
}

/**
 * Render ticker items into a container.
 * @param {string} containerId — ID of the ticker content element
 * @param {object} [priceData] — Optional pre-fetched price data
 */
export async function renderTicker(containerId, priceData) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const data = priceData || await fetchPrices();

    let html = '';
    for (const [coinId, meta] of Object.entries(SYMBOLS)) {
        const coin = data[coinId];
        if (!coin) continue;
        const change = coin.usd_24h_change || 0;
        const changeColor = change >= 0 ? 'text-green-400' : 'text-red-400';

        html += `
            <div class="flex items-center gap-3 px-6 whitespace-nowrap">
                <span class="text-luxury-gold font-bold">${meta.sym}</span>
                <span class="text-luxury-white font-mono">${formatPrice(coin.usd)}</span>
                <span class="${changeColor} text-xs font-mono">${formatChange(change)}</span>
            </div>
            <div class="w-px h-4 bg-luxury-white/10 mx-2"></div>
        `;
    }

    // Duplicate for seamless loop
    container.innerHTML = html + html;
}

/**
 * Start auto-scrolling the ticker.
 * @param {string} trackId — ID of the overflow wrapper
 * @param {string} contentId — ID of the inner scrollable div
 */
export function startTickerScroll(trackId, contentId) {
    const track = document.getElementById(trackId);
    const content = document.getElementById(contentId);
    if (!track || !content) return;

    let offset = 0;
    const speed = 0.5; // px per frame

    function scroll() {
        offset -= speed;
        if (Math.abs(offset) >= content.scrollWidth / 2) offset = 0;
        content.style.transform = `translateX(${offset}px)`;
        requestAnimationFrame(scroll);
    }
    requestAnimationFrame(scroll);
}

/**
 * Auto-refresh prices every 60s.
 * @param {string} containerId
 */
export function startAutoRefresh(containerId) {
    setInterval(async () => {
        // Force cache expiry by clearing it
        localStorage.removeItem(CACHE_KEY);
        await renderTicker(containerId);
    }, CACHE_TTL);
}
