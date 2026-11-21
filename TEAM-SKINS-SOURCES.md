# Team Block skin sources

Keep this file updated whenever skins are ported, replaced, or swapped.

Raw port data also lives in `_team-skins-*.csv` (especially `_team-skins-ported.csv`).

## Format

| Skin | Source plugin | Original style in that plugin | Notes |
|------|---------------|-------------------------------|-------|

Plugin path: `mascot-core-{source}/`

## Skins 1–9 (from evolta baseline)

`elemental-addons` was originally forked from `mascot-core-evolta`. Skins **1–9** came from evolta’s team-block styles 1–9 (not from the later `_team-skins-ported.csv` bulk port). SCSS for 1–6 still tracks evolta (~83–95% after EA class renames / Skin1 DOM work).

| Skin | Source | Orig. style | Notes |
|------|--------|-------------|-------|
| 1 | evolta | 1 | Skin1 standard DOM |
| 2 | evolta | 2 | |
| 3 | evolta | 3 | |
| 4 | evolta | 4 | |
| 5 | evolta | 5 | |
| 6 | evolta | 6 | |
| 7 | **now** `saasive` | 2 | swapped with 55; former evolta 7 → 55 |
| 8 | **now** `creovibe` | 2 | swapped with 56; former evolta 8 → 56 |
| 9 | **now** `elderkare` | 3 | swapped with 57; former evolta 9 → 57 |

## Skins 10–59 (initial port)

From `_team-skins-ported.csv` (`newStyle` ← `mascot-core-{source}` `oldStyle`):

| Skin | Source | Orig. style | Later changes |
|------|--------|-------------|---------------|
| 10 | archiora | 1 | |
| 11 | homeify | 3 | |
| 12 | caargo | 1 | **swapped with 58** → now `carpenterz` style4 |
| 13 | forexy | 4 | |
| 14 | industrius | 5 | |
| 15 | elegence | 6 | |
| 16 | stepsync | 7 | |
| 17 | elderkare | 8 | |
| 18 | webtec | 9 | |
| 19 | webtec | 10 | |
| 20 | metricx | 1 | |
| 21 | beauta | 2 | |
| 22 | movingza | 1 | |
| 23 | villahub | 4 | |
| 24 | lawfix | 5 | |
| 25 | bixom | 3 | forced after digiora broke |
| 26 | yachtex | 7 | |
| 27 | carentz | 1 | |
| 28 | omrah | 1 | |
| 29 | beauta | 1 | |
| 30 | carentz | 2 | **replaced by 59** → now `degency` style2 |
| 31 | denge | 3 | |
| 32 | onicx | 1 | |
| 33 | logico | 5 | |
| 34 | logico | 6 | |
| 35 | builton | 2 | |
| 36 | yachtex | 8 | |
| 37 | desix | 5 | |
| 38 | buildz | 1 | |
| 39 | nexella | 1 | |
| 40 | dermisio | 3 | |
| 41 | medikale | 1 | |
| 42 | softeck | 5 | |
| 43 | webtec | 1 | |
| 44 | digiplus | 7 | |
| 45 | transkom | 2 | |
| 46 | wellova | 1 | |
| 47 | builton | 1 | |
| 48 | wastex | 1 | |
| 49 | desify | 3 | |
| 50 | ecovolt | 1 | |
| 51 | onicx | 2 | |
| 52 | webtec | 2 | |
| 53 | rooftex | 1 | |
| 54 | nexella | 2 | |
| 55 | saasive | 2 | **swapped with 7** → now former skin 7 design |
| 56 | creovibe | 2 | **swapped with 8** → now former skin 8 design |
| 57 | elderkare | 3 | **swapped with 9** → now former skin 9 design |
| 58 | carpenterz | 4 | **swapped with 12** → now `caargo` style1 |
| 59 | degency | 2 | still degency; skin 30 is a copy of this |

## Design swaps / replaces log

| Date | Change |
|------|--------|
| 2026-11-05 | Skin 30 design replaced by skin 59 (`degency`) |
| 2026-11-05 | Swap 7 ↔ 55, 8 ↔ 56, 9 ↔ 57 |
| 2026-11-05 | Swap 12 ↔ 58 |

## Related CSV files

- `_team-skins-ported.csv` — initial port map (newStyle, oldStyle, source)
- `_team-skins-picked.csv` — candidate picks from inventory
- `_team-skins-inventory.csv` — all mascot-core team skins found
- `_team-skins-replaced-*.csv` / `_team-skins-similarity.csv` — dupe/notch replacement rounds
